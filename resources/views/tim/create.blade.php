@extends('layout.main')

@section('title', 'Tambah Tim')
@section('subtitle', 'Tim')
@section('content')

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Tim</h4>
                    <p class="card-description"> Masukkan data berikut untuk tambah tim </p>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="nama_tim">Nama Tim</label>
                            <input type="text" class="form-control" name="nama_tim">
                            @error('nama_tim')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_tim">Deskripsi Tim</label>
                            <textarea class="form-control" name="deskripsi_tim" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_berdiri">Tanggal Berdiri</label>
                            <input type="date" class="form-control" name="tanggal_berdiri">
                            @error('tanggal_berdiri')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="anggota_id">Anggota Tim</label>
                            <select multiple class="form-control" name="anggota_id">
                                <option value="">Pilih Anggota</option>
                                @foreach ($anggota as $item)
                                    <option value="{{ $item['id'] }}"> {{ $item['username'] }}</option>
                                @endforeach
                            </select>
                            {{-- @error('anggota_id')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                          <label for="logo">Logo</label>
                          <input value="logo" type="file" class="form-control" name="logo"
                              placeholder="Logo Tim">
                          @error('logo')
                              <span class="text-danger"> {{ $message }}</span>
                          @enderror
                      </div>
                        <div class="form-group">
                            <label for="nama_tim">Kontak Tim</label>
                            <input type="text" class="form-control" name="kontak_tim" placeholder="no. telp atau email">
                            @error('kontak_tim')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="../../index.html" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
