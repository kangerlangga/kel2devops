@extends('layouts.admin.admin')

@section('title')
<title>{{ $judul }} | SMPN 2 Tulangan</title>
@endsection

@section('pageHeading')
<h1 class="h3 mb-2 text-gray-800"><b>{{ $judul }}</b></h1>
@endsection

@section('page')
<div class="row">
    <div class="col-12 table-responsive">
    <a href="{{ route('ekstra.tambah') }}" class="btn btn-success mb-3 fw-bold">Tambahkan Ekstrakurikuler</a>
        <table class="table table-bordered pt-3" id="tabel-ekstra">
        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 13%;">
            <col span="1" style="width: 17%;">
        </colgroup>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nama Ekstrakurikuler</th>
                    <th>Visibilitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($DataEkstra as $e)
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><center><img src="{{  url('') }}/img/foto/ekstra/{{ $e->foto_ekstra }}" width="95%"></center></td>
                        <td>{{ $e->nama_ekstra }}</td>
                        <td>{{ $e->visib_ekstra }}</td>
                        <td>
                            <a href="{{ route('ekstra.edit', $e->id_ekstra) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('ekstra.hapus', $e->id_ekstra) }}" class="btn btn-danger tbl-hapus"><i class="fa-solid fa-trash"></i></a>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#{{ $e->id_detail }}">
                            <i class="fa-solid fa-circle-info"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="{{ $e->id_detail }}" tabindex="-1" role="dialog" aria-labelledby="{{ $e->id_detail }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="{{ $e->id_detail }}Label"><b>Detail Ekstrakurikuler</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $e->detail_ekstra }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                </div>
                                </div>
                            </div>
                            </div>

                            @if (Auth::user()->level == 'Super Admin')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#{{ $e->id_ekstra }}">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="{{ $e->id_ekstra }}" tabindex="-1" role="dialog" aria-labelledby="{{ $e->id_ekstra }}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{ $e->id_ekstra }}Label"><b>Riwayat Aktivitas</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Created : <br>{{ $e->created_by }} <b>({{ $e->created_at }})</b></p>
                                        <p>Last Modified : <br>{{ $e->modified_by }} <b>({{ $e->updated_at }})</b></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    let table = new DataTable('#tabel-ekstra');

    $(document).on('click','.tbl-hapus',function(e) {

        //Hentikan aksi default
        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Ini Akan Dihapus Secara Permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#fd7e14',
        confirmButtonText: 'HAPUS DATA',
        cancelButtonText: 'BATAL'
        }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href1;
        }
        })
    })

    //message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
@endsection
