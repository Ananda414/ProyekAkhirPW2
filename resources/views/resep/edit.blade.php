@extends('layout.main')

@section('title', 'Edit Resep')
@section('subtitle', 'Resep')
@section('content')

<h2>Edit Resep</h2>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="{{ route('resep.update', $resep->id) }}" method="POST"
                enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <p class="card-description">
                    Edit Informasi Resep
                </p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Resep/Barang</label>
                      <div class="col-sm-9">
                        <input value="{{$resep -> nama}}"  type="text" class="form-control @error('nama') is-invalid @enderror" 
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
                        <input value="{{$resep -> spesifikasi}}"  type="text" class="form-control" 
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
                        <input value="{{$resep -> jumlah}}"  type="number" class="form-control @error('jumlah') is-invalid @enderror" 
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
                        <input value="{{$resep -> kondisi_baik}}"  type="number" class="form-control @error('kondisi_baik') is-invalid @enderror" 
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
                        <input value="{{$resep -> terpakai}}"  type="number" class="form-control" 
                        name="terpakai" placeholder="Jika tidak ada dikosongkan saja">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <input value="{{ old('foto', $resep->foto) }}" type="file" class="form-control" name="foto"
                      placeholder="Foto Resep">
                  @error('foto')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                  @if ($resep->foto)
                      <div class="mt-2">
                        <img src="../../storage/images/' . $resep->foto" alt="Current photo" width="100">
                        <p>Foto saat ini: {{ $resep->foto }}</p>
                      </div>
                  @endif
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{ url('listresep') }}" class="btn btn-light">Cancel</button></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection