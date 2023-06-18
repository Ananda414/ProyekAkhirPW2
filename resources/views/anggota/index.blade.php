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
                @if (count($anggotas) != 0)
                    <button class="btn btn-danger d-flex justify-content-end flex-column" id="multi-delete" data-route="{{ route('anggota-multi-delete')
                    }}">Delete All Selected</button>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check-all"></th>
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
                                    <td><input type="checkbox" class="check" value="{{ $item->id }}"></td>
                                    <td> {{ $item->nama_depan }} {{ $item->nama_belakang }} </td>
                                    <td> {{ $item->jenis_kelamin }} </td>
                                    <td> {{ $item->tanggal_lahir }} </td>
                                    <td> {{ $item->username }} </td>
                                    <td> {{ $item->email }} </td>
                                    <td> {{ $item->kota_lahir }} </td>
                                    <td> {{ $item->status }} </td>
                                    <td><img src= "{{ asset ('storage/images/' .$item->foto) }}" /> </td>
                                    <td> {{ $item->created_at }} </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                          <a href="{{ route('anggota.edit', $item->id)}}">
                                            <button class="btn btn-success btn-sm">Edit</button></a>
                                          <form method="POST" class="delete-form" data-route="{{ route
                                          ('anggota.destroy', $item->id)}}">
                                              @method('delete')
                                              @csrf
                                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                          </form>      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://www.jqueryscript.net/demo/check-all-rows/dist/TableCheckAll.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#posts-table").TableCheckAll();

    $('#multi-delete').on('click', function() {
      var button = $(this);
      var selected = [];
      $('#posts-table .check:checked').each(function() {
        selected.push($(this).val());
      });

      Swal.fire({
        icon: 'warning',
          title: 'Are you sure you want to delete selected record(s)?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: button.data('route'),
            data: {
              'selected': selected
            },
            success: function (response, textStatus, xhr) {
              Swal.fire({
                icon: 'success',
                  title: response,
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Yes'
              }).then((result) => {
                window.location='/listanggota'
              });
            }
          });
        }
      });
    });
});
$('.delete-form').on('submit', function(e) {
      e.preventDefault();
      var button = $(this);
      Swal.fire({
        icon: 'warning',
          title: 'Are you sure you want to delete this record?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: button.data('route'),
            data: {
              '_method': 'delete'
            },
            success: function (response, textStatus, xhr) {
              Swal.fire({
                icon: 'success',
                  title: response,
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Yes'
              }).then((result) => {
                window.location='/listanggota'
              });
            }
          });
        }
      });
      
    });
</script>

@endsection