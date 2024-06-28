@extends('layout.main')

@section('title', 'Edit Simplisa')
@section('subtitle', 'Simplisa')
@section('content')

<h2>Edit Simplisa</h2>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="{{ route('simplisa.update', $simplisa->id) }}" method="POST"
                enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <p class="card-description">
                    Edit Informasi Simplisa
                </p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Simplisa</label>
                      <div class="col-sm-9">
                        <input value="{{$simplisa -> nama}}"  type="text" class="form-control @error('nama') is-invalid @enderror" 
                        name="nama" placeholder="Tidak boleh sama">
                        @error('nama')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Spesifikasi</label>
                      <div class="col-sm-9">
                        <input value="{{$simplisa -> spesifikasi}}" type="text" class="form-control" 
                        name="spesifikasi" placeholder="Jika tidak ada dikosongkan saja">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jumlah</label>
                      <div class="col-sm-9">
                        <input value="{{$simplisa -> jumlah}}"  type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                        name="jumlah" placeholder="0 jika tidak ada">
                        @error('jumlah')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kondisi Baik</label>
                      <div class="col-sm-9">
                        <input value="{{$simplisa -> kondisi_baik}}"  type="number" class="form-control @error('kondisi_baik') is-invalid @enderror" 
                        name="kondisi_baik" placeholder="0 jika tidak ada">
                        @error('kondisi_baik')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Terpakai</label>
                      <div class="col-sm-9">
                        <input value="{{$simplisa -> terpakai}}"  type="number" class="form-control" 
                        name="terpakai" placeholder="Jika tidak ada dikosongkan saja">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <input value="{{ old('foto', $simplisa->foto) }}" type="file" class="form-control" name="foto"
                      placeholder="Foto Simplisa">
                  @error('foto')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                  @if ($simplisa->foto)
                      <div class="mt-2">
                        <img src="../../storage/images/' . $simplisa->foto" alt="Current photo" width="100">
                        <p>Foto saat ini: {{ $simplisa->foto }}</p>
                      </div>
                  @endif
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{ url('listsimplisa') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
