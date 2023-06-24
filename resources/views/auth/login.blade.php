@extends('main')
@section('content')
@section('title')
    {{ 'Login' }}
@endsection




<div class="flex justify-center items-center px-4 py-8 md:px-0 md:py-0" style="height: calc(100vh - 80px)">
    <div class="w-full max-w-sm">
        @include('alert')
        <form class="w-full border border-gray-400 shadow rounded bg-white py-4 px-6" method="POST"
            action="{{ route('login') }}">
            @csrf
            <div class="text-gray-800 text-center text-2xl font-extrabold">
                ĐĂNG NHẬP TÀI KHOẢN
            </div>
            <div class="border-t border-gray-600 w-32 mx-auto mt-1"></div>
            <div id="thongbao"></div>
            <span>
                <div class="mt-4">
                    <label class="block text-gray-800 text-sm font-semibold mb-1">Tên tài khoản</label>
                    <input type="text" placeholder="Nhập tài khoản" id="name" name="name"
                        value="{{ old('name') }}" 
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none @error('name') is-invalid @enderror">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </span>

            <div class="my-2">
                <label class="block text-gray-800 text-sm font-semibold mb-1">Mật khẩu</label>
                <input autocomplete="current-password" type="password" name="password" id="password"
                    placeholder="Nhập mật khẩu"
                    class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none @error('password') is-invalid @enderror">
                <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </span>

            <div class="mt-4 mb-2 flex justify-center flex-col">
                <button type="submit"  style="font-size: 21px !important;"
                    class="focus:outline-none h-10 bg-red-600 text-white flex items-center justify-center rounded w-full p-1 px-8 text-xl">
                    Đăng Nhập
                </button>
                <p class="text-center text-primary"><a href="#">Quên mật khẩu</a></p>
                <a href="{{ route('register') }}" style="font-size: 21px !important;"
                    class="mt-2 py-1 rounded border border-gray-400 bg-white text-gray-800 text-xl flex items-center justify-center relative"><i
                        class="absolute bx bxs-user-plus" style="left: 10px;"></i> Tạo Tài Khoản</a>
            </div>
        </form>
    </div>
</div>
</div>



@endsection

