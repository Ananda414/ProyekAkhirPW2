@extends('layout.main')

@section('title', 'Edit Proyek')
@section('subtitle', 'Proyek')
@section('content')

<h2>Edit Tim</h2>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="{{ route('proyek.update', $proyek->id) }}" method="POST"
                enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <p class="card-description">
                    Edit Informasi Proyek
                </p>
                <div class="form-group">
                  <label for="nama_tim">Nama Proyek</label>
                  <input value="{{$proyek -> nama_proyek}}"  type="text" class="form-control" name="nama_proyek">
                  @error('nama_proyek')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="deskripsi_proyek">Deskripsi Proyek</label>
                  <textarea value="{{$proyek -> deskripsi_proyek}}" class="form-control" name="deskripsi_proyek" 
                  rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label for="deadline">Deadline</label>
                  <input value="{{$proyek -> deadline}}" type="date" class="form-control" 
                  name="deadline">
                  @error('deadline')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="budget">Budget</label>
                  <input value="{{$proyek -> budget}}" type="text" class="form-control" 
                  name="budget">
                  @error('budget')
                      <span class="text-danger"> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="tim_id">Tim</label>
                  <select name="tim_id" class="form-control">
                      <option value="">Pilih Tim</option>
                      @foreach ($tim as $item)
                          <option
                          @if ($proyek->tim_id == $item ['id']) selected @endif
                          value="{{ $item['id'] }}"> {{ $item['nama_tim'] }}</option>
                      @endforeach
                  </select>
                  @error('tim_id')
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