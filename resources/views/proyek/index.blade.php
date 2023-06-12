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
                            {{-- @foreach ($fakultas as $item)
                                <tr>
                                    <td> {{ $item->nama_fakultas }} </td>
                                    <td> {{ $item->nama_dekan }} </td>
                                    <td> {{ $item->nama_wakil_dekan }} </td>
                                    <td>
                                        @foreach ($item->prodi as $prodi)
                                            {{ $prodi->nama_prodi }}
                                        @endforeach
                                    </td>
                                    <td> {{ $item->created_at }} </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection