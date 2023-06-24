@extends('homePage.main')
@section('title')
    {{ 'Edit-Weapon' }}
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">EDIT WEAPONS</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit weapon here</h6>
            </div>
            {{-- form --}}
            <div class="card-body">
                <form method="POST" action="{{ route('edit.weapon') }}" id="edit_weapons"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $weapon->id }}">

                    <div class="mb-3">
                        <label for="nameHero" class="form-label">Name weapon</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter name weapon" value="{{ $weapon->name }}">
                            <div class="text-danger" id="name-error" style="display:none;"></div>
                    </div>

                    <div class="group mb-3">
                        <label for="" class="form-label">Your old photos</label>
                        @foreach ( explode('|', $weapon->files) as $file)
                        <img src="/uploads/imageWeapon/{{ $file }}" width="50px"
                        height="50px" alt="image">
                        @endforeach
                    </div>
                    <div class="input-group mb-3">
                        <label for="files" class="input-group-text">Multiple files input example</label>
                        <input type="file" class="form-control" name="files[]" id="files" multiple>
                    </div>
                    
                    <div class="text-danger" id="files-error" style="display:none;"></div>

                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="text">Update Weapon</span>

                    </button>
                </form>

            </div>

        </div>
    </div>
@endsection
