@extends('homePage.main')
@section('title')
    {{ 'Add-Account' }}
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">EDIT ACCOUNT</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit account</h6>
            </div>
            {{-- form --}}
            <div class="card-body">

                <form method="POST" action="{{ route('editPost.account') }}" id="edit_account" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $Account->id }}" name="id">
                    <div class="mb-3">
                        <label for="nameHero" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $Account->name }}"
                            id="name" placeholder="Enter name ">
                        <div class="text-danger" id="name-error" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="account_name" class="form-label">Name Account</label>
                        <input type="text" name="account_name" class="form-control" value="{{ $Account->account_name }}"
                            id="account_name" placeholder="Enter name account">
                        <div class="text-danger" id="name_account-error" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Account</label>
                        <input type="text" name="password" value="{{ $Account->password }}" class="form-control"
                            id="password" placeholder="Enter name account">
                        <div class="text-danger" id="pass_account-error" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="hero" class="form-label">Add Hero</label>
                        {{-- {{ dd($selected_heroes) }} --}}

                        <select name="hero[]" id="hero" class="form-control js-example-basic-multiple"
                            multiple="multiple" data-placeholder="choice your hero">

                            @foreach ($hero as $heros)
                                <option value="{{ $heros->id }}" >
                                    {{ $heros->name }} </option>
                                    {{-- {{ $heros->id, $selected_hero ? 'selected' : '' }} --}}
                            @endforeach


                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="weapon" class="form-label">Add Weapon</label>

                        <select name="weapon[]" id="weapon" class="form-control js-example-basic-multiple"
                            multiple="multiple" data-placeholder="choice your weapon">
                            @foreach ($weapon as $weapons)
                                <option value="{{ $weapons->id }}">{{ $weapons->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="servers" class="form-label">Server</label>
                        <select class="form-control" id="servers" aria-placeholder="servers" name="servers" required>
                            {{-- <option value=""> Server</option> --}}

                            <option value="ASIAN" {{ $Account->server == 'ASIAN' ? 'selected' : '' }}>ASIAN</option>
                            <option value="AMERICA" {{ $Account->server == 'AMERICA' ? 'selected' : '' }}>AMERICA</option>
                            <option value="EUROPE" {{ $Account->server == 'EUROPE' ? 'selected' : '' }}>EUROPE</option>
                            <option value="TW,HK,MO" {{ $Account->server == 'TW,HK,MO' ? 'selected' : '' }}>TW,HK,MO
                            </option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control"
                            id="price" placeholder="Enter Price">
                        <div class="text-danger" id="price-error" style="display:none;"></div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="files" class="input-group-text">Multiple files input Image Account</label>
                        <input type="file" class="form-control" name="files[]" id="files" multiple>
                    </div>
                    <div class="text-danger" id="files-error" style="display:none;"></div>

                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="text">UPDATE Account</span>

                    </button>
                </form>

            </div>

        </div>
    </div>
@endsection
