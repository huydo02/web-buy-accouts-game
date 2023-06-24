@extends('main')
@section('title')
    {{ 'Chi tiết - Thanh toán' }}
@endsection
@section('content')

    <div class="v-theme">
        <div class="pb-10">
            <div class="v-card w-full max-w-6xl mx-auto">
                <div class="md:mx-0">
                    <div class="py-6">
                        <div class="mb-16">
                            <div class="mb-4 py-4 md:p-4 bg-box-dark">
                                <div
                                    class="fade-in mb-2 py-2 md:mb-4 block uppercase md:py-4 text-center text-yellow-400 md:text-3xl text-2xl font-extrabold text-fill ">
                                    DANH MỤC:
                                    GIỎ HÀNG </div>
                                <div class="sticky col-span-12 grid grid-cols-10 gap-2 select-none py-2 px-2 color-grant text-xl font-bold rounded"
                                    style="background: rgb(37 37 37); top: 0px; z-index: 98;">
                                    <div class="col-span-10 md:col-span-10">
                                        <div class="flex items-center flex-wrap text-yellow-500 pt-2">
                                            <div class="relative">
                                                {{-- {{ $accounts->price }}đ --}}
                                                Danh sách tài khoản đã thêm vào giỏ hàng 
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="v-skull-top col-span-10 md:col-span-5 text-yellow-500 flex justify-end items-center flex-wrap">


                                    </div>
                                </div>
                                <div>
                                    <div class="v-account-detail p-2 md:px-0 ">
                                        <div class="v-infomations border-t border-gray-700 py-4">

                                        </div>
                                        @if (session()->has('accounts'))
                                            <section class="h-100" style="background-color: #eee;">
                                                <div class="container h-100 py-5">
                                                    <div class="row d-flex justify-content-center align-items-center h-100">
                                                        <div class="col-10">

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-4">
                                                                <h3 class="fw-normal mb-0 text-black">số lượng sản phẩm :
                                                                    {{ count(session('accounts')) }}</h3>
                                                                {{-- {{ dd(session()->get('accounts')) ; }}  --}}

                                                                @php
                                                                    $totalPrice = 0;
                                                                    foreach (session()->get('accounts') as $value) {
                                                                        $totalPrice += $value->price;
                                                                    }
                                                                @endphp

                                                                {{-- <p class="fw-normal mb-0 font-size: 0.8rem text-yellow-500">Total price:
                                                                    {{ $totalPrice }}</p> --}}

                                                                <div>
                                                                    <p class="mb-0"><span class="font-size: 0.8rem, text-yellow-500">Total Price: {{ number_format($totalPrice) }} </span>
                                                                        
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            @foreach (session()->get('accounts') as $account)
                                                                <div class="card rounded-3 mb-4" style="background: white">
                                                                    <div class="card-body p-4">
                                                                        <div
                                                                            class="row d-flex justify-content-between align-items-center">
                                                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                                                <img src="/uploads/imageAccount/{{ $account['file'] }}"
                                                                                    class="img-fluid rounded-3"
                                                                                    alt="Cotton T-shirt">
                                                                            </div>
                                                                            <div class="col-md-2 col-lg-2 col-xl-2"
                                                                                style="color: black">
                                                                                <p class="lead fw-normal mb-2">Tướng 5*:
                                                                                    {{ count(explode('|', $account['hero'])) }}
                                                                                </p>
                                                                                <p class="lead fw-normal mb-2">Vũ khí 5*:
                                                                                    {{ count(explode('|', $account['weapon'])) }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-4 col-xl-3 d-flex"
                                                                                style="color: black">
                                                                                {{ $account['content'] }}
                                                                            </div>
                                                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1"
                                                                                style="color: #F59E0B; font-weight: 800; font-size: 150%">
                                                                                <h5 class="mb-0">{{number_format($account['price']) }}đ
                                                                                </h5>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                                                <a href="javascript:void(0)"  onclick="deleteCart({{ $account['id'] }})" class="text-danger"><i
                                                                                        class="fas fa-trash fa-lg"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                            <div class="card" style="background: white">
                                                                <div class="card-body">
                                                                    <form  method="post" action="{{ route('buyCart') }}" id="buyNow">
                                                                        <input type="hiden" id="idMoney" value="{{ $totalPrice }}">
                                                                    <button type="submit"
                                                                        class="btn btn-warning btn-block btn-lg">Mua
                                                                        Ngay</button>
                                                                    </form>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        @else
                                        <div class="col-span-10 md:col-span-10">
                                            <div class="flex items-center flex-wrap text-yellow-500 pt-2">
                                                <div class="relative">
                                                    {{-- {{ $accounts->price }}đ --}}
                                                    Giỏ Hàng Trống
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="v-account-detail p-2 md:px-0">

                                    </div>
                                    <div class="v-account-detail p-2 md:px-0 ">
                                        <div class="v-account-detail-1" id="taikhoan">
                                            <div class="mb-10r">
                                                {{-- <img src="/uploads/imageAccount/{{ $accounts->file }}" data-sizes="auto"
                                                    class="border border-gray-400 mb-2 w-full lazyLoad lazy" /> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Global site tag (gtag.js) - Google Analytics -->

@endsection
