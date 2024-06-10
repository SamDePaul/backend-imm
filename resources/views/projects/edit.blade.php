@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Project') }}</h1>
    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="tags" id="tags" class="form-control" required>
                <option value=""></option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $project->tag_id == $tag->id ? 'selected' : '' }}>{{ $tag->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="judul">Title</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $project->judul) }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $project->deskripsi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tujuan">Propose</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ old('tujuan', $project->tujuan) }}" required>
        </div>
        <div class="form-group">
            <label for="targetPelanggan">Target Pelanggan</label>
            <select name="targetPelanggan" id="targetPelanggan" class="form-control" required>
                <option value=""></option>
                <option value="Pekerja Swasta">Pekerja Swasta</option>
                <option value="Pegawai Negeri Sipil (PNS)">Pegawai Negeri Sipil (PNS)</option>
                <option value="Wiraswasta">Wiraswasta</option>
                <option value="Dokter">Dokter</option>
                <option value="Guru">Guru</option>
                <option value="Pengacara">Pengacara</option>
                <option value="Polisi">Polisi</option>
                <option value="Tentara">Tentara</option>
                <option value="Buruh">Buruh</option>
                <option value="Petani">Petani</option>
                <option value="Nelayan">Nelayan</option>
                <option value="Pengusaha">Pengusaha</option>
                <option value="Karyawan">Karyawan</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Pelajar">Pelajar</option>
                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                <option value="Seniman">Seniman</option>
                <option value="Pengrajin">Pengrajin</option>
                <option value="Jurnalis">Jurnalis</option>
                <option value="Peneliti">Peneliti</option>
                <option value="Teknisi">Teknisi</option>
                <option value="Arsitek">Arsitek</option>
                <option value="Insinyur">Insinyur</option>
                <option value="Akuntan">Akuntan</option>
                <option value="Perawat">Perawat</option>
                <option value="Pustakawan">Pustakawan</option>
                <option value="Apoteker">Apoteker</option>
                <option value="Sopir">Sopir</option>
                <option value="Satpam">Satpam</option>
                <option value="Petugas Kebersihan">Petugas Kebersihan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggalMulai">Date Start</label>
            <input type="datetime-local" class="form-control" id="tanggalMulai" name="tanggalMulai" value="{{ old('tanggalMulai', \Carbon\Carbon::parse($project->tanggalMulai)->format('Y-m-d\TH:i')) }}" required>
        </div>
        <div class="form-group">
            <label for="tanggalSelesai">Date End</label>
            <input type="datetime-local" class="form-control" id="tanggalSelesai" name="tanggalSelesai" value="{{ old('tanggalSelesai', \Carbon\Carbon::parse($project->tanggalSelesai)->format('Y-m-d\TH:i')) }}" required>
        </div>
        <div class="form-group">
            <label for="negara">Negara</label>
            <select name="negara" id="negara" class="form-control" required>
                <option value=""></option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ $project->negara_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
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
            <label for="data_path">Data Import</label>
            <input type="file" class="form-control-file" id="data_path" name="data_path" accept="image/*">
            @if($project->data_path)
                <p>Current File: <a href="{{ asset('storage/' . $project->data_path) }}" target="_blank">{{ $project->data_path }}</a></p>
            @endif
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" id="kategori" name="kategori" required>
                <option value="bisnis baru" {{ $project->kategori == 'bisnis baru' ? 'selected' : '' }}>Bisnis Baru</option>
                <option value="bisnis yang sudah ada" {{ $project->kategori == 'bisnis yang sudah ada' ? 'selected' : '' }}>Bisnis yang Sudah Ada</option>
            </select>
        </div>
        <div class="form-group">
            <label for="dana">Jumlah Dana</label>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="dana" name="dana" value="{{ old('dana', $project->dana) }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_dana">Jenis Dana</label>
            <select class="form-control" id="jenis_dana" name="jenis_dana" required>
                <option value="hibah" {{ $project->jenis_dana == 'hibah' ? 'selected' : '' }}>Hibah</option>
            </select>
        </div>
        <div class="form-group">
            <label for="dana_lain">Jumlah Dana</label>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="dana_lain" name="dana_lain" value="{{ old('dana_lain', $project->dana_lain) }}" required>
        </div>
        <div class="form-group">
            <label for="sdg">Kategory SDG</label>
            <select name="sdg" id="sdg" class="form-control" required>
                <option value=""></option>
                @foreach($sdgs as $sdg)
                    <option value="{{ $sdg->id }}" {{ $project->sdg_id == $sdg->id ? 'selected' : '' }}>{{ $sdg->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="indikator">Indicator</label>
            <select name="indikator" id="indikator" class="form-control" required disabled>
                <option value="">Pilih SDG Terlebih Dahulu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="matrik">Metric</label>
            <select name="matrik" id="matrik" class="form-control" required disabled>
                <option value="">Pilih Tag Terlebih Dahulu</option>
            </select>
        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">{{ __('Update Project') }}</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">{{ __('Back to Projects') }}</a>
        </div>
    </form>
@endsection
