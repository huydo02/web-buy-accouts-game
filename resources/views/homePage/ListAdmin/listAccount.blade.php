@extends('homePage.main')
@section('content')
@section('title')
    {{ 'List-Account' }}
@endsection
<style>
    .info-line .hero-details .hero-icon {
        width: 35px;
        height: 35px;
        background-size: cover;
        background-position: center center;
        content: " ";
        cursor: pointer;
        display: inline-block;
    }
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Accounts</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        {{-- <th>name</th> --}}
                                        <th>account_name</th>
                                        <th>password</th>
                                        <th>hero</th>
                                        <th>weapon</th>
                                        <th>server</th>
                                        <th>price</th>
                                        <th>file</th>

                                        {{-- <th>Date</th> --}}
                                        <th>Setting</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($Account as $Accounts)
                                        <tr>
                                            <th>{{ $Accounts->id }}</th>
                                            <th>{{ $Accounts->account_name }}</th>
                                            <th>{{ $Accounts->password }}</th>
                                            <th>

                                                {{-- @foreach (json_decode($Accounts->hero) as $heros)
                                                    @php
                                                        $image = DB::table('hero')
                                                            ->select('files')
                                                            ->where('id', $heros)
                                                            ->first();
                                                    @endphp
                                                    <img src="/uploads/{{ $image->files }}" width="50px"
                                                        height="50px" alt="image">
                                                @endforeach --}}

                                                @foreach (explode('|',$Accounts->hero) as $heros)
                                                    <img src="/uploads/{{ DB::table('hero')->where('id', $heros)->value('files') }}"
                                                        style="margin-bottom: 5px; width: 50px; height: 50px;"
                                                        alt="image" data-toggle="tooltip" title=""
                                                        data-original-title="{{ DB::table('hero')->where('id', $heros)->value('name') }}">
                                                @endforeach
                                            </th>
                                            <th>
                                                @foreach (explode('|',$Accounts->weapon) as $weapons)
                                                    <img src="/uploads/imageWeapon/{{ DB::table('weapons')->where('id', $weapons)->value('files') }}"
                                                        style="margin-bottom: 5px; width: 50px; height: 50px;"
                                                        alt="image" data-toggle="tooltip" title=""
                                                        data-original-title="{{ DB::table('weapons')->where('id', $weapons)->value('name') }}">
                                                @endforeach
                                                {{-- {{ $Accounts->weapon }} --}}
                                            </th>
                                            <th>{{ $Accounts->server }}</th>
                                            <th>{{ $Accounts->price }}</th>
                                            {{-- <th>{{ $Accounts->file }}</th> --}}
                                            <th>
                                                @foreach (explode('|', $Accounts->file) as $file)
                                                    <img src="/uploads/imageAccount/{{ $file }}"
                                                        style="margin-bottom: 5px; width: 50px; height: 50px;"alt="image">
                                                @endforeach
                                            </th>
                                            {{-- <th>{{ $Accounts->created_at }}</th> --}}
                                            <th style="text-align: center;">

                                                <a href="{{ route('edit.account', $Accounts->id) }} "
                                                            class="btn btn-primary ">
                                                            <i class="fa-solid fa-gear"></i>
                                                        </a>

                                                <a href="javascript:void(0)" class="btn btn-danger "
                                                    onclick="removeAccount({{ $Accounts->id }})">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $show_products->links() }} --}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

    </div>
    <!-- End of Content Wrapper -->
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
