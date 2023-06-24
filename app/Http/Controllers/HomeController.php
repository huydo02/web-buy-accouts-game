<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\account;
use App\Models\views;
use App\Models\User;


use Illuminate\Support\Facades\Http;
use App\Models\card_auto;
use App\Models\hero;
use App\Models\history;

use App\Models\weapon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserFollowNotification;

class HomeController extends Controller
{
    use Notifiable;
    /**
     * Create a new controller instance.
     *
     *
     * @return void
     */
    public function __construct()
    {
        // redirect()->route('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function notify(){
    //     if (auth()->user()) {
    //         $user = User::find(auth()->user()->id);
    //         auth()->user()->notify(new UserFollowNotification($user));
    //         }
    // }
    public function index()
    {
        views::find(1)->increment('views');
        return view('homes');
    }
    public function detail($id)
    {
        $accounts = account::find($id);
        // dd($accounts);

        return view('detail', compact('accounts'));
    }

    public function cart()
    {
        return view('cart');
    }
    public function add_card()
    {
        return view('addCard');
    }
    public function buy_history()
    {   
        $history = history::where('id_user',Auth::user()->id)->paginate(10);
        return view('history_buy',compact('history'));
    }
    public function post_card(Request $request)
    {
        // dd($request);

        function generateRandomString($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $card_network = $request->card_network;
        $card_value = $request->card_value;
        $card_seri = $request->card_seri;
        $card_pin = $request->card_pin;
        $tranid = generateRandomString(16);
        $partner_id = env('PARTNER_ID');
        $partner_key = env('PARTNER_KEY');
        $data = array(
            'telco' => $card_network,
            'code' => $card_pin,
            'serial' => $card_seri,
            'amount' => $card_value,
            'request_id' => $tranid,
            'partner_id' => $partner_id,
            'sign' => md5($partner_key . $card_pin . $card_seri),
            'command' => 'charging'
        );

        $curl = curl_init();
        $response = Http::get('http://trumthe.vn/chargingws/v2?' . http_build_query($data));

        // dd($response->body());
        
        // dd($response->json())
        if ($response->json()['status'] == 99) {
            $card_auto = new card_auto();
            $card_auto->username = Auth::user()->id;
            $card_auto->loaithe = $card_network;
            $card_auto->menhgia = $card_value;

            $card_auto->thoigian = Carbon::now();
            $card_auto->trangthai = 'Processing';

            $card_auto->seri     = $card_seri;
            $card_auto->pin = $card_pin;
            $card_auto->request_id = $tranid;
            $card_auto->save();
        }
        return $response->json();
        // return  $card_value;

    }
    public function deleteCart($id)
    {
        $cart = session()->get('accounts');
        foreach ($cart as $key => $value) {
            if ($value->id == $id) {
                unset($cart[$key]);
                break;
            }
        }
        session()->put('accounts', $cart);
        return response()->json([
            'status' => 200,
            'success' => "Xóa thành công!",
        ]);
    }
    //post cart
    public function post_cart(Request $request)
    {
        $accounts = account::find($request->id);
        if (session()->exists('accounts')) {
            $existingAccounts = collect(session('accounts'));
            // Check if the account already exists in the session
            if (!$existingAccounts->contains('id', $accounts->id)) {
                // Push the new account to the existing accounts session
                session()->push('accounts', $accounts);
            } else {
                return response()->json([
                    'status' => 206,
                    // 'session' => $accounts,
                    'warning' => "Tài khoản đã tồn tại trong giỏ hàng.",
                ]);
            }
        } else {
            // If there is no existing accounts session, create a new one with the first account
            session()->put('accounts', array($accounts));
        }
        // Retrieve the updated accounts session
        $accounts = session()->get('accounts');
        // $request->session()->forget('accounts');
        // dd($accounts);
        if (session()->exists('accounts')) {
            return response()->json([
                'status' => 200,
                'session' => $accounts,
                'success' => "Thêm vào giỏ hàng thành công!",
            ]);
        } else {
            return response()->json([
                'status' => 405,
                // 'session' =>$accounts,
                'err' => "Đã xảy ra lỗi, vui lòng nhấn F5 để thực hiện lại!",
            ]);
        }


        // return dd($accounts);
    }

    public function buy_post_cart(Request $request)
    {
        // dd($request->total);
        if (Auth::check()) {
            if ($request->total == 0) {
                return response()->json([
                    'status' => 405,
                    'error' => "Giỏ hàng trống!",
                ]);
            } else {
                $total = account::where('id', $request->total)->value('price');
                
                $id = auth()->user()->id;
                $money = auth()->user()->money;
                if ($money >= $total) {
                    User::where('id', $id)
                        ->update(['money' => $money - $total]);
            // phần thêm vào lịch sử mua
                    $history = new history();
                    $history->id_user = auth()->user()->id;
                    $history->name = account::where('id', $request->total)->value('account_name');
                    $history->password = account::where('id', $request->total)->value('password');
                    $history->price = account::where('id', $request->total)->value('price');
                    // dd($history->name);
                    $history->save();
                    $user = auth()->user();
                    //tạo thông báo trên admin
                    $arr = [
                        'name' => $user->id,
                        'paid' => $request->id,
                    ];
                    $user->notify(new UserFollowNotification($arr));
                } elseif ($money < $total) {
                    return response()->json([
                        'status' => 400,
                        'error' => "Mua hàng không thành công. Bạn cần nạp thêm để thanh toán",
                    ]);
                }

            }
            return response()->json([
                'status' => 200,
                'success' => "Mua hàng thành công. vui lòng kiểm tra trong lịch sử mua tài khoản để xem thông tin tài khoản",
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'error' => "Bạn chưa đăng nhập. vui lòng đăng nhập để sử dụng tính năng này",
            ]);
        }
    }

    public function buy_cart(Request $request)
    {
        if (Auth::check()) {
            if ($request->id == 0) {
                return response()->json([
                    'status' => 405,
                    'error' => "Giỏ hàng trống!",
                ]);
            } else {
                // $user = Auth::user();
                // $money = $user->money;
                $money = User::where('id', Auth::user()->id)->value('money');
                // dd($money);
                if ($money >= (int)$request->id) {
                    // dd(gettype($request->id));
                    User::where('id', Auth::user()->id)
                        ->update(['money' => $money - (int)$request->id]);
                    $request->session()->forget('accounts');

                    $history = new history();
                    $history->id_user = auth()->user()->id;
                    //phần này còn lỗi
                    $history->name = account::where('id', $request->total)->value('account_name');
                    $history->password = account::where('id', $request->total)->value('password');
                    $history->price = (int)$request->id;
                    // dd($history->name);
                    $history->save();

                    $user = auth()->user();
                    //tạo thông báo trên admin
                    $arr = [
                        'name' => $user->id,
                        'paid' => $request->id,
                    ];
                    $user->notify(new UserFollowNotification($arr));
                } elseif ($money < (int)$request->id) {
                    return response()->json([
                        'status' => 400,
                        'error' => "Mua hàng không thành công. Bạn cần nạp thêm để thanh toán",
                    ]);
                }
            }
            return response()->json([
                'status' => 200,
                'success' => "Mua hàng thành công. vui lòng kiểm tra trong lịch sử mua tài khoản để xem thông tin tài khoản",
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'error' => "Bạn chưa đăng nhập. vui lòng đăng nhập để sử dụng tính năng này",
            ]);
        }
    }

    public function list_nomal(Request $request)
    {
        $hero = hero::select('id', 'name')->get();
        $weapon = weapon::select('id', 'name')->get();
        // $accounts = account::all()->paginate(1);
        $accounts = DB::table('account')->select('*')->paginate(9);
        // dd($request);

        if (empty($request->search)) {
            return view('listAccNomal', compact('accounts', 'hero', 'weapon'));
        } elseif ($request->has('search')) {
            $accounts = Account::query();

            // dd($request->input('servers'));
            // Xử lý trường hợp tìm kiếm theo tên tướng
            if ($request->has('hero')) {
                // dd($request->hero);
                $heroes = implode("|", $request->hero);
                $accounts->where('hero', 'LIKE', '%' . $heroes . '%');
            }

            // Xử lý trường hợp tìm kiếm theo vũ khí
            if ($request->has('weapon')) {
                $weapons = implode("|", $request->weapon);
                $accounts->where('weapon', 'LIKE', '%' . implode("|", $request->weapon) . '%');
            }

            // // Xử lý trường hợp tìm kiếm theo AR thấp nhất
            if ($request->has('ar')) {
                $ar = $request->input('ar');
                $accounts->when($ar != null, function ($query) use ($ar) {
                    return $query->where('ar', $ar);
                });
            }

            // // // Xử lý trường hợp tìm kiếm theo giá
            if ($request->has('price')) {
                $amount = $request->input('price');
                switch ($amount) {
                    case 1:
                        $accounts->whereBetween('price', [0, 50000]);
                        break;
                    case 2:
                        $accounts->whereBetween('price', [50000, 100000]);
                        break;
                    case 3:
                        $accounts->whereBetween('price', [100000, 200000]);
                        break;
                    case 4:
                        $accounts->whereBetween('price', [200000, 500000]);
                        break;
                    case 5:
                        $accounts->where('price', '>', 500000);
                        break;
                    default:
                        break;
                }
            }

            // // // Xử lý trường hợp sắp xếp giá
            if ($request->has('sort_price')) {
                $sort_price = $request->input('sort_price');

                $accounts->when($sort_price != null, function ($query) use ($sort_price) {

                    return $query->orderBy('price', $sort_price);
                });
            }

            // // Xử lý trường hợp tìm kiếm theo server

            if ($request->has('servers')) {
                $servers = $request->input('servers');
                $accounts->when($servers != null, function ($query) use ($servers) {
                    // Sau đó, when được sử dụng để thêm điều kiện cho truy vấn nếu $servers khác null. when có hai đối số: một là một biểu thức boolean, và hai là một hàm closure. Nếu biểu thức boolean đánh giá là true, thì closure sẽ được gọi và truyền đối tượng truy vấn vào như một đối số. Closure này sẽ thực hiện thêm điều kiện vào truy vấn bằng cách sử dụng phương thức where để chỉ định rằng chỉ có những bản ghi có giá trị server giống $servers mới được lấy từ cơ sở dữ liệu.
                    return $query->where('server', $servers);
                });
            }

            // Thực hiện truy vấn và lấy kết quả
            $accounts = $accounts->paginate(10);
            // $accounts = DB::table('accounts')->paginate(10);
            return view('listAccNomal', compact('accounts', 'hero', 'weapon'));
        }
    }
    //list acc vip

    public function list_accVip(Request $request)
    {
        $hero = hero::select('id', 'name')->get();
        $weapon = weapon::select('id', 'name')->get();
        // $accounts = account::all()->paginate(1);
        $accounts = DB::table('account')->select('*')->paginate(9);
        // dd($request);

        if (empty($request->search)) {
            return view('listAccvip', compact('accounts', 'hero', 'weapon'));
        } elseif ($request->has('search')) {
            $accounts = Account::query();

            // dd($request->input('servers'));
            // Xử lý trường hợp tìm kiếm theo tên tướng
            if ($request->has('hero')) {
                // dd($request->hero);
                $heroes = implode("|", $request->hero);
                $accounts->where('hero', 'LIKE', '%' . $heroes . '%');
            }

            // Xử lý trường hợp tìm kiếm theo vũ khí
            if ($request->has('weapon')) {
                $weapons = implode("|", $request->weapon);
                $accounts->where('weapon', 'LIKE', '%' . implode("|", $request->weapon) . '%');
            }

            // // Xử lý trường hợp tìm kiếm theo AR thấp nhất
            if ($request->has('ar')) {
                $ar = $request->input('ar');
                $accounts->when($ar != null, function ($query) use ($ar) {
                    return $query->where('ar', $ar);
                });
            }

            // // // Xử lý trường hợp tìm kiếm theo giá
            if ($request->has('price')) {
                $amount = $request->input('price');
                switch ($amount) {
                    case 1:
                        $accounts->whereBetween('price', [0, 50000]);
                        break;
                    case 2:
                        $accounts->whereBetween('price', [50000, 100000]);
                        break;
                    case 3:
                        $accounts->whereBetween('price', [100000, 200000]);
                        break;
                    case 4:
                        $accounts->whereBetween('price', [200000, 500000]);
                        break;
                    case 5:
                        $accounts->where('price', '>', 500000);
                        break;
                    default:
                        break;
                }
            }

            // // // Xử lý trường hợp sắp xếp giá
            if ($request->has('sort_price')) {
                $sort_price = $request->input('sort_price');

                $accounts->when($sort_price != null, function ($query) use ($sort_price) {

                    return $query->orderBy('price', $sort_price);
                });
            }

            // // Xử lý trường hợp tìm kiếm theo server

            if ($request->has('servers')) {
                $servers = $request->input('servers');
                $accounts->when($servers != null, function ($query) use ($servers) {
                    // Sau đó, when được sử dụng để thêm điều kiện cho truy vấn nếu $servers khác null. when có hai đối số: một là một biểu thức boolean, và hai là một hàm closure. Nếu biểu thức boolean đánh giá là true, thì closure sẽ được gọi và truyền đối tượng truy vấn vào như một đối số. Closure này sẽ thực hiện thêm điều kiện vào truy vấn bằng cách sử dụng phương thức where để chỉ định rằng chỉ có những bản ghi có giá trị server giống $servers mới được lấy từ cơ sở dữ liệu.
                    return $query->where('server', $servers);
                });
            }

            // Thực hiện truy vấn và lấy kết quả
            $accounts = $accounts->paginate(10);
            // $accounts = DB::table('accounts')->paginate(10);
            return view('listAccvip', compact('accounts', 'hero', 'weapon'));
        }
    }
}
