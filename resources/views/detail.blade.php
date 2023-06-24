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
                                    TÀI KHOẢN GENSHIN VIP </div>
                                <div class="sticky col-span-12 grid grid-cols-10 gap-2 select-none py-2 px-2 color-grant text-xl font-bold rounded"
                                    style="background: rgb(37 37 37); top: 0px; z-index: 98;">
                                    <div class="col-span-10 md:col-span-5">
                                        <div class="flex items-center flex-wrap text-yellow-500 pt-3">
                                            <div class="relative">
                                                {{ number_format($accounts->price)  }}đ
                                                <span class="absolute" style="top: -18px; left: 1px; font-size: 0.8rem;">
                                                    GIÁ BÁN
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="v-skull-top col-span-10 md:col-span-5 text-yellow-500 flex justify-end items-center flex-wrap">
                                        
                                        <form method="post" action="{{ route('buypostcart') }}" id="buyformAddCart">
                                            @csrf
                                            <input type="hidden" name="buycartId" id="buycartId" value="{{ $accounts->id }}">
                                            <button type="submit" class="ml-4 flex bg-yellow-500 text-white items-center justify-center h-10 text-2xl rounded focus:outline-none px-4 text-center" id="btnCarts">
                                                THANH TOÁN
                                            </button>
                                        </form>

                                        <form method="post" action="{{ route('postcart') }}" id="formAddCart">
                                            @csrf
                                            <input type="hidden" name="id" id="cartId" value="{{ $accounts->id }}">
                                            <button type="submit" class="ml-4 flex bg-red-500 text-white items-center justify-center h-10 text-2xl rounded focus:outline-none px-4 text-center" id="btnCarts">
                                                THÊM VÀO GIỎ
                                            </button>
                                        </form>

                                        
                                        

                                    </div>
                                </div>
                                <div>
                                    <div class="v-account-detail p-2 md:px-0 ">
                                        <div class="v-infomations border-t border-gray-700 py-4">
                                            <div class="w-full grid grid-cols-12 gap-4">
                                                <div
                                                    class="uppercase col-span-6 md:col-span-3 text-base md:text-xl font-semibold text-center">
                                                    <span class="text-white">MÃ: </span>
                                                    <b class="text-yellow-600">#{{ $accounts->id }}</b>
                                                </div>
                                                <div
                                                    class="uppercase col-span-6 md:col-span-3 text-base md:text-xl font-semibold text-center">
                                                    <span class="text-white">CẤP AR: </span>
                                                    <b class="text-yellow-600">{{ $accounts->ar }}</b>
                                                </div>
                                                <div
                                                    class="uppercase col-span-6 md:col-span-3 text-base md:text-xl font-semibold text-center">
                                                    <span class="text-white">KHU VỰC:</span>
                                                    <b class="text-yellow-600">{{ $accounts->server }}</b>
                                                </div>

                                            </div>
                                            <div>
                                                <p style="text-align: center; color: #a9a1a1;">{{ $accounts->content }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="v-infomations border-gray-700 ">
                                                    <p
                                                        style=" color: white; text-align: center; font-size: 20px;font-weight: bold;">
                                                        TƯỚNG 5*</p>
                                                    <div class="row g-0 info-line">
                                                        <section class="row g-0 text-center">
                                                            <label class="col-12 pb-2">Số lượng:
                                                                {{ count(explode('|', $accounts->hero)) }}</label>
                                                            <span class="col hero-details">
                                                                @foreach (explode('|', $accounts->hero) as $hero)
                                                                    @php
                                                                        $heros = DB::table('hero')
                                                                            ->select('files', 'name')
                                                                            ->where('id', $hero)
                                                                            ->first();
                                                                    @endphp

                                                                    <i class="hero-icon-detail"
                                                                        style="background: url('/uploads/{{ $heros->files }}');background-size: cover;"
                                                                        data-toggle="tooltip"
                                                                        title="{{ $heros->name }}"></i>
                                                                @endforeach

                                                            </span>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="v-infomations border-gray-700 ">
                                                    <p
                                                        style=" color: white; text-align: center; font-size: 20px;font-weight: bold;">
                                                        VŨ KHÍ*</p>
                                                    <div class="row g-0 info-line">
                                                        <section class="row g-0 text-center">
                                                            <label class="col-12 pb-2">Số lượng:
                                                                {{ count(explode('|', $accounts->weapon)) }} </label>
                                                            <span class="col hero-details">
                                                                @foreach (explode('|', $accounts->weapon) as $weapon)
                                                                    @php
                                                                        $weapons = DB::table('weapons')
                                                                            ->select('files', 'name')
                                                                            ->where('id', $weapon)
                                                                            ->first();
                                                                    @endphp
                                                                    <i class="hero-icon-detail"
                                                                        style="background: url('/uploads/imageWeapon/{{ $weapons->files }}'); background-size: cover;"
                                                                        data-toggle="tooltip"
                                                                        title="{{ $weapons->name }}"></i>
                                                                @endforeach
                                                            </span>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="v-account-detail p-2 md:px-0">

                                    </div>
                                    <div class="v-account-detail p-2 md:px-0 ">
                                        <div class="v-account-detail-1" id="taikhoan">
                                            <div class="mb-10r">
                                                <img src="/uploads/imageAccount/{{ $accounts->file }}" data-sizes="auto"
                                                    class="border border-gray-400 mb-2 w-full lazyLoad lazy" />
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
