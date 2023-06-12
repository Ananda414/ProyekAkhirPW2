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
                <h4 class="card-title">Daftar Anggota</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Kota Lahir</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggotas as $item)
                                <tr>
                                    <td> {{ $item->nama_depan }} {{ $item->nama_belakang }} </td>
                                    <td> {{ $item->jenis_kelamin }} </td>
                                    <td> {{ $item->tanggal_lahir }} </td>
                                    <td> {{ $item->username }} </td>
                                    <td> {{ $item->email }} </td>
                                    <td> {{ $item->kota_lahir }} </td>
                                    <td> {{ $item->status }} </td>
                                    <td><img src= "{{ asset ('storage/images/' .$item->foto) }}" /> </td>
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