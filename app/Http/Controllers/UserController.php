<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\hero;
use App\Models\weapon;
use App\Models\User;
use App\Models\card_auto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    
    public function callback(Request $request){
        // return view('callback');
        // $status = $request->status;
        dd( $request);
        $validator = Validator::make($request->all(), [
            'status' => 'required|alpha_num',
            'message' => 'required',
            'request_id' => 'required|alpha_num',
            'declared_value' => 'required|alpha_num',
            'value' => 'required|alpha_num',
            'amount' => 'required|alpha_num',
            'code' => 'required|alpha_num',
            'serial' => 'required|alpha_num',
            'telco' => 'required|alpha_num',
            
            'trans_id' => 'required|alpha_num',
            'callback_sign' => 'required|alpha_num',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag(),
        ]);
        }
        else {
                $status = $request->status;
                $message = $request->message;
                $request_id = $request->request_id;
                $declared_value = $request->declared_value;
                $value = $request->value;
                $amount = $request->amount;
                $code = $request->code;
                $serial = $request->serial;
                $telco = $request->telco;
                $chietkhau = $request->chietkhau;
                $trans_id = $request->trans_id;
                $callback_sign = $request->callback_sign;

                if($status == 1){
                    $requestId= card_auto::select('username')->where('request_id',$request_id)->get();
                    if ($requestId->isNotEmpty()) {
                        $id = $requestId[0]->username;
                        $updateuser = User::find($id);
                        $updateuser->money = $updateuser->money + $amount;
                        $updateuser -> update();
                    
                    $card =  DB::update("update card_auto set `trangthai` = 'Success',`thucnhan` = ".$amount." where `request_id` = '".$request_id ."'");
                    }  //đang bằng id của users
                    // dd($name);
                    
                    

                }
                else {
                    $card =  DB::update("update card_auto set `trangthai` = 'Failed',`thucnhan` = 0 where `request_id` = '".$request_id ."'");
                    
                }
        }
        

     }
}
