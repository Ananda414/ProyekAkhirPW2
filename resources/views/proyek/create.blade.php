@extends('layout.main')

@section('title', 'Tambah Proyek')
@section('subtitle', 'Proyek')
@section('content')

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Tambah Proyek</h4>
                        <p class="card-description"> Masukkan data berikut untuk tambah proyek </p>
                        <form class="forms-sample" action="{{ route('proyek.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                          <div class="form-group">
                            <label for="nama_proyek">Nama Proyek</label>
                            <input value="{{ old('nama_proyek') }}" type="text" class="form-control" name="nama_proyek">
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
                            <input value="{{ old('deadline') }}" type="date" class="form-control" name="deadline">
                            @error('deadline')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="budget">Budget</label>
                            <input value="{{ old('budget') }}" type="text" class="form-control" name="budget">
                            @error('budget')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="tim_id">Tim </label>
                            <select class="form-control" name="tim_id">
                                <option value="">Pilih Tim</option>
                                @foreach ($tim as $item)
                                    <option value="{{ $item['id'] }}"> {{ $item['nama_tim'] }}</option>
                                @endforeach
                            </select>
                            @error('tim_id')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-primary me-2">Submit</button>
                          <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>
              </div>
@endsection