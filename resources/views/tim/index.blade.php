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
                                <th>Ketua Tim</th>
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
                                    <td>
                                        <div class="d-flex justify-content-between">
                                          <a href="{{ route('tim.edit', $item->id)}}">
                                            @can('update', $item)
                                            <button class="btn btn-success btn-sm">Edit</button>
                                            @endcan
                                          </a>
                                          <form method="POST" class="delete-form" data-route="{{ route
                                          ('tim.destroy', $item->id)}}">
                                              @method('delete')
                                              @csrf
                                              @can('delete', $item)
                                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                              @endcan
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
                window.location='/listim'
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
                window.location='/listim'
              });
            }
          });
        }
      });
      
    });
</script>
@endsection