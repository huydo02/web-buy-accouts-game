@extends('homePage.main')
@section('title')
    {{ 'Add-Products' }}
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">ADD HEROS</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">More hero here</h6>
            </div>
            {{-- form --}}
            <div class="card-body">
                <form method="POST" action="{{ route('post.products') }}" id="add_products"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nameHero" class="form-label">Name hero</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter name hero">
                            <div class="text-danger" id="name-error" style="display:none;"></div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="files" class="input-group-text">Multiple files input example</label>
                        <input type="file" class="form-control" name="files[]" id="files" multiple>
                    </div>
                    <div class="text-danger" id="files-error" style="display:none;"></div>

                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="text">Add Hero</span>

                    </button>
                </form>

            </div>

        </div>
    </div>
@endsection
