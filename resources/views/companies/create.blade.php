@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add Company') }}</h1>

    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan:</label>
            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
        </div>
        <div class="form-group">
            <label for="profil_perusahaan">Profil Perusahaan:</label>
            <textarea class="form-control" id="profil_perusahaan" name="profil_perusahaan"></textarea>
        </div>
        <div class="form-group">
            <label for="nama_pic">Nama PIC:</label>
            <input type="text" class="form-control" id="nama_pic" name="nama_pic" required>
        </div>
        <div class="form-group">
            <label for="posisi_pic">Posisi PIC:</label>
            <input type="text" class="form-control" id="posisi_pic" name="posisi_pic" required>
        </div>
        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <div class="form-group">
            <label for="provinsi">Provinsi:</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" required>
        </div>
        <div class="form-group">
            <label for="kabupaten">Kabupaten:</label>
            <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
        </div>
        <div class="form-group">
            <label for="jumlah_karyawan">Jumlah Karyawan:</label>
            <input type="number" class="form-control" id="jumlah_karyawan" name="jumlah_karyawan" required>
        </div>
        <div class="form-group">
            <label for="tipe_perusahaan">Tipe Perusahaan:</label>
            <input type="text" class="form-control" id="tipe_perusahaan" name="tipe_perusahaan" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
