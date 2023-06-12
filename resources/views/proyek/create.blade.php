@extends('layout.main')

@section('title', 'Tambah Anggota')
@section('subtitle', 'Anggota')
@section('content')

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Tambah Proyek</h4>
                        <p class="card-description"> Masukkan data berikut untuk tambah proyek </p>
                        <form class="forms-sample">
                          <div class="form-group">
                            <label for="nama_proyek">Nama Proyek</label>
                            <input type="text" class="form-control" name="nama_proyek">
                            @error('nama_proyek')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="deskripsi_proyek">Deskripsi Proyek</label>
                            <textarea class="form-control" name="deskripsi_proyek" rows="4"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="date" class="form-control" name="deadline">
                            @error('deadline')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="budget">Budget</label>
                            <input type="number" class="form-control" name="budget">
                            @error('budget')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="anggota_id">Tim </label>
                            <select multiple class="form-control" name="anggota_id">
                                <option value="">Pilih Anggota</option>
                                @foreach ($tim as $item)
                                    <option value="{{ $item['id'] }}"> {{ $item['username'] }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                          {{-- <div class="form-group">
                            <label>Logo Tim</label>
                            <input type="file" name="logo" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Logo" name="gambar_logo">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button" name="upload">Upload</button>
                              </span>
                            </div>
                          </div> --}}
                          <button type="submit" class="btn btn-primary me-2">Submit</button>
                          <a href="../../index.html" class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>
              </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
            </div>
          </footer>
@endsection