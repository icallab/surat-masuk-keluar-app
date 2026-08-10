@extends('layouts.dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Surat Keluar</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Surat Keluar</li>
                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->

        </div><!-- /.container-fluid -->


    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    @if (Auth::user()->level == 'tatausaha')
                        <div class="btn-group" style="margin-bottom: 2%">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Tambah Surat Keluar
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('tambah_surat_keluar') }}">Internal</a>
                                <a class="dropdown-item" href="{{ route('tambah_surat_keluar_external') }}">External</a>
                            </div>
                        </div>
                    @endif
                    <table id="myTable" class="table center-aligned-table myTable dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 20%">No Surat</th>
                                <th style="width: 20%">Judul Surat</th>
                                <th style="width: 13%; text-align:center ">Tanggal</th>
                                @if (Auth::user()->level == 'kepsek' || Auth::user()->level == 'tatausaha')
                                    
                                    <th style="width: 5%">Status</th>
                                    <th style="width: 13%">Kepada</th>
                                @endif
                                <th style="width:8%;text-align: center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inbox as $outgoingmail)
                                <tr 
                                @if (! Auth::user()->level == 'kepsek' && App\Models\Auth::user()->level == 'tatausaha')
                                @if ($outgoingmail->mark == 'unread') style="font-weight:bold;" @endif
                                @endif
                                
                                >
                                    <td>{{ App\Models\outgoingmail::where('id', $outgoingmail->id)->value('no_sk') }}
                                    </td>
                                    <td style="">{{ $outgoingmail->judul_sk }}</td>
                                    <td style="text-align: center;">{{ $outgoingmail->tgl_keluar }}</td>
                                    <td>
                                        @if (Auth::user()->level == 'kepsek' || Auth::user()->level == 'tatausaha')
                                            
                                            @if ($outgoingmail->status == 'disetujui')
                                                <span class="badge badge-success">Surat {{ $outgoingmail->status }}</span>
                                            @elseif ($outgoingmail->status == 'ditolak')
                                                <span class="badge badge-danger">Surat {{ $outgoingmail->status }}</span>
                                            @elseif ($outgoingmail->status == 'belum')
                                                <span class="badge badge-warning">{{ $outgoingmail->status }}
                                                    dikonfimasi</span>
                                            @endif
                                            
                                    </td>
                                    @if (!App\Models\user::where('id', $outgoingmail->kepada)->value('name'))
                                        <td style="">{{ $outgoingmail->kepada_external }}</td>
                                    @endif
                                    @if (App\Models\user::where('id', $outgoingmail->kepada)->value('name'))
                                        <td style="">
                                            {{ App\Models\user::where('id', $outgoingmail->kepada)->value('name') }}</td>
                                    @endif
                            

                            {{-- <td>{{ App\Models\User::where('id', $mail->mail_from)->value('name') }}</td> --}}
                            {{-- <td>{{ App\Models\User::where('id', $mail->mail_to)->value('name')}}</td> --}}
                            <td style="text-align: center" >
                                @endif
                                @if ($outgoingmail->status == 'disetujui' || $outgoingmail->status == 'ditolak')
                                @endif



                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{-- @if (Auth::user()->level == 'kepsek')
                                                Konfirmasi Surat
                                            @endif --}}

                                    Aksi

                                </a>



                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item"
                                        href="{{ route('detail_keluar', $outgoingmail->id) }}">Detail</a>
                                    @if (Auth::user()->level == 'tatausaha')
                                    <a  onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini ?')){return true;}else{event.stopPropagation(); event.preventDefault();};" href="{{ route('hapus_surat_keluar', $outgoingmail->id) }}"
                                        class="dropdown-item">Hapus
                                    </a>
                                        <a class="dropdown-item"
                                             type="submit" data-toggle="modal"
                                                        data-target="#examplemModal{{ $outgoingmail->id }}">Edit
                                        </a>
                                    @endif
                                    @if (Auth::user()->level == 'kepsek')
                                        <a class="dropdown-item"
                                            href="{{ route('konfirmasi_setuju', $outgoingmail->id) }}">Setuju</a>
                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#modal-default{{ $outgoingmail->id }}">
                                            Tolak
                                        </button>
                                    @endif

                                </div>
                                </a>
                            </td>
                            </tr>
                            <div class="modal fade" id="modal-default{{ $outgoingmail->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('konfirmasi_tolak') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $outgoingmail->id }}">
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan
                                                        Penolakan</label>
                                                    <input type="text" name="keterangan" class="form-control"
                                                        id="keterangan" aria-describedby="keterangan">
                                                </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            
                            <div class="modal fade bd-example-modal-lg"
                                            id="examplemModal{{ $outgoingmail->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="examplemModalLabel">Edit Surat Keluar
                                                        </h5>
                                                        <button type="button" class="Kembali" data-dismiss="modal"
                                                            aria-label="Kembali">
                                                            <span aria-hidden="true">Close</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ action('App\Http\Controllers\OutgoingMailController@edit', $outgoingmail->id) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">Kepada</label>
                                                                    @if (!$outgoingmail->kepada)
                                                                    <input type="text" class="form-control"
                                                                            name="kepada_external"
                                                                            value="{{  $outgoingmail->kepada_external }}">
                                                                    @endif

                                                                @if ($outgoingmail->kepada)
                                                                <select class="form-control" name="kepada">
                                                                    @foreach ($user as $data)
                                                                    @if ($data->id == $outgoingmail->kepada)
                                                                    <option value="{{ $data->id }}" selected>
                                                                    @endif
                                                                    @if ($data->id != $outgoingmail->kepada)
                                                                    <option value="{{ $data->id }}" >
                                                                        
                                                                    @endif
                                                                    {{ $data->name }} ({{ $data->level }})</option>
                                                                    @endforeach
                                                                </select>
                                                                @endif 
                                                                    
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nomor Surat
                                                                            Keluar</label>
                                                                        <input type="text" class="form-control"
                                                                            name="no_sk"
                                                                            value="{{  $outgoingmail->no_sk }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Judul Surat
                                                                            Keluar</label>
                                                                        <input type="text" class="form-control"
                                                                            name="judul_sk"
                                                                            value="{{  $outgoingmail->judul_sk }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tipe
                                                                            Surat</label>
                                                                        <select class="form-control" name="id_type">
                                                                            @foreach ($type as $data)
                                                                            @if ($data->id == $outgoingmail->id_type)
                                                                                <option value="{{ $data->id }}" selected>
                                                                                    {{ $data['type'] }}</option>
                                                                                    @endif
                                                                                    @if ($data->id !== $outgoingmail->id_type)
                                                                                <option value="{{ $data->id }}" >
                                                                                    {{ $data['type'] }}</option>
                                                                                    @endif
                                                                            @endforeach
                                                                        </select>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tujuan Surat</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tujuan_surat"
                                                                            value="{{  $outgoingmail->tujuan_surat }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tanggal Keluar</label>
                                                                        <input type="date" class="form-control"
                                                                            name="tgl_keluar"
                                                                            value="{{  $outgoingmail->tgl_keluar }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Perihal</label>
                                                                        <input type="text" class="form-control"
                                                                            name="perihal_sk"
                                                                            value="{{  $outgoingmail->perihal_sk }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label form="exampleInputEmail1">Isi Surat</label>
                                                                <textarea class="form-control" rows="3" name="isi_sk" >{{  $outgoingmail->isi_sk }}</textarea>
                                                            </div>


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Lampiran</label>
                                                            <input type="file" name="file_sk" class="form-control"
                                                                 aria-describedby="emailHelp" 
                                                                accept="application/pdf" >{{ $outgoingmail->file_sk }}
                                                        
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-outline-success mr-2">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>

                            <!-- /.modal -->
                            @endforeach

                        </tbody>
                    </table>
                </div>


            </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true
            });
        });
    </script>



    <script>
        function confirmasi(e) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    window.location.href = "/surat-hapus/" + e;
                }
            })
        }
    </script>
@endsection
