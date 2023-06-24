@extends('homePage.main')
@section('title') {{ 'Add-Weapon' }}@endsection
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">ADD WEAPON</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">More weapon here</h6>
        </div>
        {{-- form --}}
        <div class="card-body">
        <form action="{{ route('post.weapon') }}" method="POST" id="add_Weapon" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name weapon</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name weapon">
                <div class="text-danger" id="name-error" style="display:none;"></div>

              </div>
              <div class="input-group mb-3">
                <label for="files" class="input-group-text">Multiple files input example</label>
                <input type="file" name="files[]" class="form-control" id="files" multiple>
              </div>
              <div class="text-danger" id="files-error" style="display:none;"></div>

              <button type="submit" class="btn btn-primary btn-icon-split">
                <span class="text">Add weapon</span>
              </button>
        </form>
        </div>
    {{-- <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script> --}}
    
</div>
</div>
@endsection