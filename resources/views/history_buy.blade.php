@extends('main')
@section('title')
    {{ 'Lịch sử mua tài khoản' }}
@endsection
@section('content')
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lịch sử mua hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    {{-- <th>name</th> --}}
                                    <th>Tên Tài Khoản</th>
                                    <th>Mật khẩu</th>
                                    <th>giá tiền</th>
                                    <th>ngày mua</th>
                            

                                    {{-- <th>Date</th> --}}
                                    

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($history as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->password }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    
    
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
</div>

@endsection
