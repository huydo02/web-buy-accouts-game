@extends('main')
@section('title')
    {{ 'Nạp Thẻ' }}
@endsection
@section('content')
    <div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
        <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
            {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> --}}
            {{-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js" type="text/javascript" charset="utf8"></script> --}}
            <div class="col-span-8 sm:col-span-3 md:col-span-2 lg:col-span-2 xl:col-span-2 lg:px-0 px-2">
                <div class="mb-4 v-menu-account">
                    <h2 class="mb-2 border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                        Tài khoản</h2>
                    <ul class="pl-2 text-white">
                        <li class="py-1"><a href="https://accgamegenshin.com/Auth/Profile" class=""><span
                                    class="relative mr-2 text-lg" style="top: 1.5px;"><i
                                        class="bx bxs-user-circle"></i></span>Thông
                                tin tài khoản</a></li>
                        <li class="py-1"><a href="https://accgamegenshin.com/bien-dong-so-du/" class=""><span
                                    class="relative mr-2 text-lg" style="top: 1.5px;"><i class="bx bxs-dollar-circle"
                                        aria-hidden="true"></i></span>Biến động số
                                dư</a></li>
                        <li class="py-1"><a href="https://accgamegenshin.com/Auth/Profile/ChangePassword"
                                class=""><span class="relative mr-2 text-lg" style="top: 1.5px;"><i
                                        class="bx bxs-lock"></i></span>Đổi mật
                                khẩu</a></li>
                    </ul>
                </div>
                <div class="my-4 v-menu-account">
                    <h2 class="mb-2 border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                        GIAO DỊCH
                    </h2>
                    <ul class="pl-2 text-white font-medium">
                        <li class="py-1">
                            <a href="https://accgamegenshin.com/nap-the-cao/" class="">
                                <span class="relative mr-2 text-lg" style="top: 1.5px;"><i
                                        class="bx bxs-star"></i></span>Nạp thẻ
                                cào tự động
                            </a>
                        </li>
                        <li class="py-1"><a href="https://accgamegenshin.com/nap-tien-qua-ngan-hang/"
                                aria-current="page"><span class="relative mr-2 text-lg" style="top:1.5px;"><i
                                        class="bx bxs-credit-card"></i></span>Nạp qua ATM/MOMO</a></li>
                        <li class="py-1">
                            <a href="https://accgamegenshin.com/History" class="">
                                <span class="relative mr-2 text-lg" style="top: 1.5px;"><i
                                        class="bx bxs-receipt"></i></span>Lịch sử
                                mua nick
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
                <div class="w-full mb-2">
                    <div class="rounded w-full">
                        <span>
                            <form method="POST" action="{{ route('post_card') }}" id="addCard" class="w-full">
                                @csrf
                                <h2
                                    class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                                    KHU NẠP THẺ
                                </h2>
                                <div class="py-3 px-5">
                                    <div class="alert alert-success">
                                        <p><span historic="" segoe="" style="font-family: " ui="">Hiện
                                                tại quý khách nạp vào 100.000 tiền thẻ cào sẽ được 80.000 tiền
                                                shop do quy đổi từ thẻ cào ra tiền mặt tốn phí</span></p>

                                        <p><span historic="" segoe="" style="background-color: rgb(255, 0, 0);"
                                                ui=""><b style=""><u style="">Sai Mệnh Giá Mất
                                                        Thẻ</u></b></span></p>
                                    </div>
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative">
                                            <select id="card_network" name="card_network"
                                                class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                                                <option value="">-- Chọn loại thẻ --</option>
                                                <option value="VIETTEL">Viettel</option>
                                                <option value="VINAPHONE">Vinaphone</option>
                                                <option value="MOBIFONE">Mobifone</option>
                                                <option value="VNMOBI">Vietnamobile</option>
                                                <option value="ZING">Zing</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="fill-current h-4 w-4">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </span>
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative">
                                            <select id="card_value" name="card_value"
                                                class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                                                <option value="">-- Chọn mệnh giá --</option>
                                                <option value="10000">10.000đ</option>
                                                <option value="20000">20.000đ</option>
                                                <option value="30000">30.000đ</option>
                                                <option value="50000">50.000đ</option>
                                                <option value="100000">100.000đ</option>
                                                <option value="200000">200.000đ</option>
                                                <option value="300000">300.000đ</option>
                                                <option value="500000">500.000đ</option>
                                                <option value="1000000">1.000.000đ</option>
                                                <option value="2000000">2.000.000đ</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="fill-current h-4 w-4">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </span>
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative"><input type="text" id="card_pin"
                                                name="card_pin" placeholder="Mã số thẻ"
                                                class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                                        </div>
                                    </span>
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative"><input type="text" id="card_seri"
                                                name="card_seri" placeholder="Số serial"
                                                class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                                        </div>
                                    </span>
                                    <div class="mt-4 text-center">
                                        <button type="submit"  style="font-size: 14px !important;"
                                            class="uppercase flex w-40 font-semibold rounded items-center justify-center h-10 text-white text-xl rounded-none focus:outline-none px-4 text-center bg-red-500 hover:bg-red-600">
                                            Nạp Thẻ
                                        </button>
                                    </div>
                                    <div class="mt-2 text-red-500 font-semibold text-sm">
                                    </div>
                                </div>
                            </form>
                        </span>
                        <!---->
                    </div>
                </div>
                <div class="v-bg w-full mb-2 px-2">
                    <h2
                        class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                        LỊCH SỬ NẠP THẺ
                    </h2>
                    <div class="v-table-content select-text">
                        <div class="py-2 overflow-x-auto scrolling-touch max-w-400">
                            <table id="datatable" class="table-auto w-full scrolling-touch min-w-850">
                                <thead>
                                    <tr class="v-border-hr select-none border-b-2 border-gray-300">
                                        <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                            STT
                                        </th>
                                        <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                            NHÀ MẠNG
                                        </th>
                                        <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                            M.GIÁ/T.NHẬN
                                        </th>
                                        <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                            MÃ THẺ
                                        </th>
                                        <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                            SERIAL THẺ
                                        </th>
                                        <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                            TRẠNG THÁI
                                        </th>
                                        <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                            NẠP LÚC
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-semibold">
                                </tbody>
                            </table>
                        </div>
                        <div class="v-table-note mt-1 py-1 font-semibold text-white text-sm">
                            Dùng điện thoại <i class="bx bxs-mobile"></i>, hãy vuốt bảng từ phải qua trái (<i
                                class="bx bxs-arrow-from-right"></i>) để xem đầy đủ thông tin!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    {{-- <script type="text/javascript">
        $("#NapThe").on("click", function() {
            $('#NapThe').html('<i class="fa fa-spinner fa-spin"></i> ĐANG XỬ LÝ').prop('disabled',
                true);
            $.ajax({
                url: "https://accgamegenshin.com/assets/ajaxs/NapThe.php",
                method: "POST",
                data: {
                    loaithe: $("#loaithe").val(),
                    menhgia: $("#menhgia").val(),
                    seri: $("#seri").val(),
                    pin: $("#pin").val()
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('#NapThe').html(
                            'Nạp Thẻ')
                        .prop('disabled', false);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        $(document).ready(function() {
            setTimeout(e => {
                GetCard24()
            }, 0)
        });

        function GetCard24() {
            $.ajax({
                url: "https://accgamegenshin.com/api/loaithe.php",
                method: "GET",
                success: function(response) {
                    $("#loaithe").html(response);
                }
            });
            $.ajax({
                url: "https://accgamegenshin.com/api/menhgia.php",
                method: "GET",
                success: function(response) {
                    $("#menhgia").html(response);
                }
            });

        }
    </script> --}}
@endsection
