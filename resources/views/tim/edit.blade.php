@extends('layout.main')

@section('title', 'Edit Tim')
@section('subtitle', 'Tim')
@section('content')

<h2>Edit Tim</h2>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="{{ route('tim.update', $tim->id) }}" method="POST"
                enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <p class="card-description">
                    Edit Informasi Tim
                </p>
                <div class="form-group">
                  <label for="nama_tim">Nama Tim</label>
                  <input value="{{$tim -> nama_tim}}"  type="text" class="form-control" name="nama_tim">
                  @error('nama_tim')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="deskripsi_tim">Deskripsi Tim</label>
                  <textarea value="{{$tim -> deskripsi_tim}}" class="form-control" name="deskripsi_tim" 
                  rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label for="tanggal_berdiri">Tanggal Berdiri</label>
                  <input value="{{$tim -> tanggal_berdiri}}" type="date" class="form-control" 
                  name="tanggal_berdiri">
                  @error('tanggal_berdiri')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="anggota_id">Ketua Tim</label>
                  <select name="anggota_id" class="form-control">
                      <option value="">Pilih Ketua</option>
                      @foreach ($anggota as $item)
                          <option
                          @if ($tim->anggota_id == $item ['id']) selected @endif
                          value="{{ $item['id'] }}"> {{ $item['username'] }}</option>
                      @endforeach
                  </select>
                  @error('anggota_id')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="logo">Logo</label>
                  <input value="{{$tim -> logo}}" type="file" class="form-control" name="logo"
                      placeholder="Logo Tim">
                  @error('logo')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="nama_tim">Kontak Tim</label>
                  <input value="{{$tim -> kontak_tim}}" type="text" class="form-control" 
                  name="kontak_tim" placeholder="no. telp atau email">
                  @error('kontak_tim')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection