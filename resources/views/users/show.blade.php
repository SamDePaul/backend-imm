@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('User Details') }}</h1>

    <div class="card">
        <div class="card-header">
            User Details
        </div>
        <div class="card-body">
            <p><strong>Nama Lengkap :</strong> {{ $user->nama_lengkap }}</p>
            <p><strong>NIK :</strong> {{ $user->nik }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Email Verified At :</strong> {{ $user->email_verified_at }}</p>
            <p><strong>Negara :</strong> {{ $user->negara }}</p>
            <p><strong>Provinsi :</strong> {{ $user->provinsi }}</p>
            <p><strong>Alamat :</strong> {{ $user->alamat }}</p>
            <p><strong>No Whatsapp :</strong> {{ $user->no_hp }}</p>
            <p><strong>Created At :</strong> {{ $user->created_at }}</p>
            <p><strong>Updated At :</strong> {{ $user->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to Users</a>
@endsection
