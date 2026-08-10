@extends('layouts.dashboard')
@section('content')
    <div class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Surat Masuk</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Surat Masuk</li>
                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->

        </div><!-- /.container-fluid -->


    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />



    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css" /> --}}

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    
                    <table id="myTable" class="table center-aligned-table myTable dt-responsive" style="width:100%">
                        @if (Auth::user()->level == 'tatausaha')
                            <a class="btn btn-primary" style="margin-bottom: 2%"
                                href="{{ route('tambah_surat_masuk') }}">Tambah Surat Masuk</a>
                        @endif
                        <thead>
                            <tr class="text-primary">
                                <th>Nomor Surat</th>
                                <th>Judul Surat</th>
                                <th>Tanggal</th>
                                <th>Asal Surat</th>
                                <th style="text-align: center">Tindakan</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inbox as $incomingmail)
                                <tr 
                                @if ($incomingmail->mark == 'unread') style="font-weight:bold;" @endif
                                >
                                    <td>{{ App\Models\incomingmail::where('id', $incomingmail->id)->value('no_sm') }}</td>
                                    <td style="">{{ $incomingmail->judul_sm }}</td>
                                    <td>{{ $incomingmail->tgl_masuk }}</td>
                                    <td>{{ $incomingmail->asal_surat }}</td>
                                    {{-- <td>{{ App\Models\User::where('id', $mail->mail_from)->value('name') }}</td> --}}
                                    {{-- <td>{{ App\Models\User::where('id', $mail->mail_to)->value('name')}}</td> --}}
                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" type="button"
                                                    href="{{ route('detail_masuk', $incomingmail->id) }}">Detail</button></a>
                                                @if (Auth::user()->level == 'tatausaha')
                                                    {{-- <form id="hapus"
                                                action="{{ route('hapus_surat_masuk', $incomingmail->id) }}"
                                                method="post">
                                                @csrf --}}
                                                    {{-- </form> --}}
                                                    {{-- <form id="delete-surat-form" method="POST"  action="{{ route('hapus_surat_masuk', $incomingmail->id) }}">
                                                    @csrf
                                                    @method('DELETE') --}}
                                                    <a  onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini ?')){return true;}else{event.stopPropagation(); event.preventDefault();};" href="{{ route('hapus_surat_masuk', $incomingmail->id) }}"
                                                        class="dropdown-item">Hapus</a>
                                                    {{-- </form> --}}

                                                    <button class="dropdown-item" type="submit" data-toggle="modal"
                                                        data-target="#examplemModal{{ $incomingmail->id }}">Edit</button>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="modal fade bd-example-modal-lg"
                                            id="examplemModal{{ $incomingmail->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="examplemModalLabel">Edit Surat Masuk
                                                        </h5>
                                                        <button type="button" class="Kembali" data-dismiss="modal"
                                                            aria-label="Kembali">
                                                            <span aria-hidden="true">Close</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ action('App\Http\Controllers\IncomingMailController@edit', $incomingmail->id) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nomor Surat
                                                                            Masuk</label>
                                                                        <input type="text" class="form-control"
                                                                            name="no_sm"
                                                                            value="{{ $incomingmail->no_sm }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Judul Surat
                                                                            Masuk</label>
                                                                        <input type="text" class="form-control"
                                                                            name="judul_sm"
                                                                            value="{{ $incomingmail->judul_sm }}">
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
                                                                            @if ($data->id ==  $incomingmail->id_type)
                                                                                <option value="{{ $data->id }}" selected>
                                                                                    {{ $data['type'] }}</option>
                                                                                    @endif
                                                                                    @if ($data->id !==  $incomingmail->id_type)
                                                                                <option value="{{ $data->id }}" >
                                                                                    {{ $data['type'] }}</option>
                                                                                    @endif
                                                                            @endforeach
                                                                        </select>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Asal Surat
                                                                            Masuk</label>
                                                                        <input type="text" class="form-control"
                                                                            name="asal_surat"
                                                                            value="{{ $incomingmail->asal_surat }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tanggal Masuk</label>
                                                                        <input type="date" class="form-control"
                                                                            name="tgl_masuk"
                                                                            value="{{ $incomingmail->tgl_masuk }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Perihal</label>
                                                                        <input type="text" class="form-control"
                                                                            name="perihal_sm"
                                                                            value="{{ $incomingmail->perihal_sm }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label form="exampleInputEmail1">Isi Surat</label>
                                                                <textarea class="form-control" rows="3" name="isi_sm" >{{ $incomingmail->isi_sm }}</textarea>
                                                            </div>


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Lampiran</label>
                                                            <input type="file" name="file_sm" class="form-control"
                                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                accept="application/pdf">{{ $incomingmail->file_sm }}
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-outline-success mr-2">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                </div>

                </a>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>

        </div>
    </section>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> 

    {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css"
        integrity="sha256-7jUS+MWeqkFdmW9ozkZ7mPagz+QmMbsBlt+Q3MsE+FU=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"
        integrity="sha256-2Dbg51yxfa7qZ8CSKqsNxHtph8UHdgbzxXF9ANtyJHo=" crossorigin="anonymous"></script> --}}


        

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


    {{-- <script>
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
    </script> --}}
@endsection
