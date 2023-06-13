@extends('layout.main')

@section('title', 'Halaman Anggota')
@section('subtitle', 'Anggota')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <h4 class="card-title">Daftar Proyek</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Proyek</th>
                                <th>Deskripsi</th>
                                <th>Deadline</th>
                                <th>Budget</th>
                                <th>Tim</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyeks as $item)
                            <tr>
                                <td> {{ $item->nama_proyek }} </td>
                                <td> {{ $item->deskripsi_proyek }} </td>
                                <td> {{ $item->deadline }} </td>
                                <td> {{ $item->budget }} </td>
                                <td> {{ $item->tim->nama_tim }} </td>
                                <td> {{ $item->created_at }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection