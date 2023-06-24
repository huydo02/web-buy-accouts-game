@extends('homePage.main')
@section('content')
@section('title')
    {{ 'List-weapons' }}
@endsection
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="#">official
            DataTables documentation</a>.</p>

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
                                                <th>name</th>
                                                <th>image</th>
                                                <th>Date</th>
                                                <th>Setting</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($show_weapons as $show_weapon)
                                                <tr>
                                                    <th>{{ $show_weapon->id }}</th>
                                                    <th>{{ $show_weapon->name }}</th>
                                                    <th>
                                                        @foreach (explode('|', $show_weapon->files) as $file)
                                                            <img src="/uploads/imageWeapon/{{ $file }}" width="50px"
                                                                height="50px" alt="image">
                                                        @endforeach
                                                    </th>
                                                    <th>{{ $show_weapon->created_at }}</th>
                                                    <th style="text-align: center;">

                                                        <a href="{{ route('editWeapon.list', $show_weapon->id) }} "
                                                            class="btn btn-primary btn-icon-spli">
                                                            Edit
                                                        </a>

                                                        <a href="javascript:void(0)" class="btn btn-dark btn-icon-spli"
                                                            onclick="removeWeapon({{ $show_weapon->id }})">
                                                            Delete
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
    $(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>
@endsection
