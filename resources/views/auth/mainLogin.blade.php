<!DOCTYPE html>
<html lang="en">
    {{-- @include('sweetalert::alert') --}}

<head>
    @include('auth.headLogin')
<title>@yield('title')</title>

</head>

<body class="bg-gradient-primary">

@yield('content')
<footer>
    @include('auth.footerLogin')
</footer>

</body>

</html>
