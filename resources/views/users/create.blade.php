@extends('layouts.admin')

@section('main-content')

    <h1 class="h3 mb-4 text-gray-800">{{ $user->exists ? __('Edit User') : __('Create User') }}</h1>

    <form action="{{ $user->exists ? route('users.update', $user->id) : route('users.store') }}" method="POST">
        @csrf
        @if($user->exists)
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nama_lengkap">Name Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
        </div>
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $user->nik) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        @unless($user->exists)
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
        @endunless
        <div class="form-group">
            <label for="no_hp">No Whatsapp</label>
            <input type="no_hp" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
        </div>
        <div class="form-group">
            <label for="negara">Negara</label>
            <select name="negara" id="negara" class="form-control" required>
                <option value=""></option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="provinsi">Region</label>
            <select name="provinsi" id="provinsi" class="form-control" required disabled>
                <option value="">Pilih Negara Terlebih Dahulu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kota">City</label>
            <select name="kota" id="kota" class="form-control" required disabled>
                <option value="">Pilih Region Terlebih Dahulu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="alamat" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}" required>
        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">
                {{ $user->exists ? __('Update User') : __('Create User') }}
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
        </div>

    </form>
    <script src="{{ asset('js/world.js') }}"></script>
@endsection
