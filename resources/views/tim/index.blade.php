@extends('layout.main')

@section('title', 'Halaman Tim')
@section('subtitle', 'Tim')
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
                <h4 class="card-title">Daftar Tim</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Tim</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Berdiri</th>
                                <th>Anggota Tim</th>
                                <th>Logo Tim</th>
                                <th>Kontak</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tims as $item)
                                <tr>
                                    <td> {{ $item->nama_tim }} </td>
                                    <td> {{ $item->deskripsi_tim }} </td>
                                    <td> {{ $item->tanggal_berdiri }} </td>
                                    <td> {{ $item->anggota->username }} </td>
                                    <td><img src= "{{ asset ('storage/images/' .$item->logo) }}" /> </td>
                                    <td> {{ $item->kontak_tim }} </td>
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