@extends('layout.main')

@section('title', 'Tambah Anggota')
@section('subtitle', 'Anggota')
@section('content')

        <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title">Tambah Anggota</h4>
                    <form class="forms-sample" action="{{ route('anggota.store')}}" method="POST"
                    enctype="multipart/form-data">
                      @csrf
                      <p class="card-description"> Masukkan data berikut untuk menambah anggota </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Depan</label>
                            <div class="col-sm-9">
                              <input value="{{ old('nama_depan') }}" type="text" class="form-control" name="nama_depan">
                              @error('nama_depan')
                                <span class="text-danger"> {{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Belakang</label>
                            <div class="col-sm-9">
                              <input value="{{ old('nama_belakang') }}" type="text" class="form-control" name="nama_belakang">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                              </select>
                              @error('jenis_kelamin')
                                <span class="text-danger"> {{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                              <input value="{{ old('tanggal_lahir') }}" type="date" class="form-control" 
                              name="tanggal_lahir">
                              @error('tanggal_lahir')
                                <span class="text-danger"> {{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                              <input value="{{ old('username') }}" type="text" class="form-control" 
                              name="username">
                              @error('username')
                                <span class="text-danger"> {{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input value="{{ old('email') }}" type="email" class="form-control" 
                              name="email">
                              @error('email')
                                <span class="text-danger"> {{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota Lahir</label>
                            <div class="col-sm-9">
                              <input value="{{ old('kota_lahir') }}" type="text" class="form-control" 
                              name="kota_lahir">
                              @error('kota_lahir')
                                <span class="text-danger"> {{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Status</label>
                             <div class="col-sm-4">
                               <div class="form-check">
                                 <label class="form-check-label">
                                   <input type="radio" class="form-check-input" name="status" value="Menikah" checked=""> Menikah <i class="input-helper"></i></label>
                               </div>
                             </div>
                             <div class="col-sm-5">
                               <div class="form-check">
                                 <label class="form-check-label">
                                   <input type="radio" class="form-check-input" name="status" value="Belum Menikah"> Belum Menikah <i class="input-helper"></i></label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <input value="{{'$anggota->foto' }}" type="file" class="form-control" name="foto"
                            placeholder="Foto">
                        @error('foto')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection