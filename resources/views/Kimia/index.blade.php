@extends('layout.main')

@section('title', 'Halaman Kimia')
@section('subtitle', 'Kimia')
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
                <h4 class="card-title">Daftar Kimia</h4>

                <!-- Tambahkan input filter -->
                <input type="text" id="filterInput" class="form-control mb-3" placeholder="Filter nama kimia...">

                <!-- Tambahkan opsi pagination dan show all -->
                <div class="mb-3">
                    <label for="perPageSelect">Number of rows:</label>
                    <select id="perPageSelect" class="form-control w-auto d-inline-block">
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <label class="form-check-label">
                        <input type="checkbox" id="showAll" class="form-check-input" {{ request('show_all')? 'checked' : '' }}>
                        Show All
                    </label>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="kimiaTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang/Zat</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kimias as $item)
                                <tr class="main-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="nama">{{ $item->nama }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm show-details" data-item="{{ json_encode($item) }}">
                                            Show
                                        </button>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                          <a href="{{ route('kimia.edit', $item->id)}}">
                                            @can('update', $item)
                                            <button class="btn btn-success btn-sm">Edit</button>
                                            @endcan
                                          </a>     
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Tampilkan link pagination -->
                @if ($kimias instanceof \Illuminate\Pagination\AbstractPaginator)
                    <div class="pagination-wrapper">
                        {{ $kimias->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
                    </div>
                @endif

                <a href="{{ route('kimia.downloadPDF') }}" class="btn btn-info">Download PDF</a>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.show-details').on('click', function() {
            var item = $(this).data('item');
            Swal.fire({
                title: 'Details',
                html: `
                    <p>Volume: ${item.volume}</p>
                    <p>Jumlah: ${item.jumlah}</p>
                    <p>Kondisi Baik: ${item.kondisi_baik}</p>
                    <p>Kondisi Tidak Baik: ${parseInt(item.jumlah) - parseInt(item.kondisi_baik)}</p>
                    <p>Terpakai: ${item.terpakai}</p>
                    <p>Sisa: ${item.terpakai === null || item.terpakai === '' ? '-' : parseInt(item.jumlah) - parseInt(item.terpakai)}</p>
                    <p>Terakhir Dipakai: ${item.terakhir_dipakai ? new Date(item.terakhir_dipakai).toLocaleString('id-ID') : '-'}</p>
                    <p>Foto: <img class="zoomable" src="../../assets/images/list/${item.foto}" style="max-width: 100px; max-height: 100px;" /></p>
                    <p>Dibuat tanggal: ${new Date(item.created_at).toLocaleString('id-ID')}</p>
                    <p>Terakhir Diperbarui: ${new Date(item.updated_at).toLocaleString('id-ID')}</p>
                    <p class="zoom-message" style="display:none;">Click again the picture to zoom out</p>
                `,
                width: 600,
                showCloseButton: true,
                focusConfirm: false
            });
        });

        // Enable image zoom
        $(document).on('click', '.zoomable', function() {
            $(this).toggleClass('zoomed');
            $('.zoom-message').toggle();
        });

        // Filter function
        $('#filterInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#kimiaTable tbody tr.main-row').each(function() {
                var text = $(this).find('.nama').text().toLowerCase();
                $(this).toggle(text.indexOf(value) > -1);
            });
        });

        // Per page select change
        $('#perPageSelect').on('change', function() {
            var perPage = $(this).val();
            window.location.href = '{{ url()->current() }}?per_page=' + perPage;
        });

        // Show all checkbox change
        $('#showAll').on('change', function() {
            if ($(this).is(':checked')) {
                window.location.href = '{{ url()->current() }}?show_all=true';
            } else {
                window.location.href = '{{ url()->current() }}';
            }
        });
    });
</script>
<style>
.zoomable {
    cursor: pointer;
    transition: transform 0.3s ease;
}

.zoomable.zoomed {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(8);
    z-index: 9999; /* Ensure it's above other content */
}

.zoom-message {
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(255, 255, 255, 0.8);
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    z-index: 10000;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination.page-item.page-link {
    margin: 0 5px;
}
</style>
@endsection
