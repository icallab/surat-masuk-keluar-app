@extends('layouts.dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Disposisi</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Disposisi</li>
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

                    <table id="myTable" class="table center-aligned-table myTable">
                        <thead>
                            <tr class="text-primary">
                                <th>Nomor Surat</th>
                                <th>Judul Surat</th>
                                <th>Tanggal</th>
                                <th>Asal Surat</th>
                                @if (Auth::user()->level == 'kepsek')
                                <th>Kepada</th>
                                @endif
                                <th style="text-align: center">Tindakan</th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if ($data->mark == 'unread') style="font-weight:bold;" @endif --}}
                            @foreach ($inbox as $data)
                                <tr >
                                    <td style="">{{ App\Models\incomingmail::where('id', $data->id_sm)->value('no_sm') }}</td>
                                    <td style="">{{ App\Models\incomingmail::where('id', $data->id_sm)->value('judul_sm') }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td style="">{{ App\Models\incomingmail::where('id', $data->id_sm)->value('asal_surat') }}</td>
                                    @if (Auth::user()->level == 'kepsek')
                                    <td style="">{{ App\Models\user::where('id', $data->kepada)->value('name') }}</td>
                                    @endif

                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                
                                                <a class="dropdown-item" type="button"
                                                    href="{{ route('detail_disposisi', $data->id) }}">Detail</button></a>
                                                @if (Auth::user()->level == 'kepsek')
                                                    {{-- <form id="hapus"
                                                action="{{ route('hapus_surat_masuk', $incomingmail->id) }}"
                                                method="post">
                                                @csrf --}}
                                                    {{-- </form> --}}
                                                    {{-- <form id="delete-surat-form" method="POST"  action="{{ route('hapus_surat_masuk', $incomingmail->id) }}">
                                                    @csrf
                                                    @method('DELETE') --}}
                                                    <a  onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini ?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                    href="{{ route('hapus_disposisi', $data->id) }}"
                                                        class="dropdown-item">Hapus</button></a>
                                                    {{-- </form> --}}

                                                    <button class="dropdown-item" type="submit" data-toggle="modal"
                                                        data-target="#examplemModal{{ $data["id"] }}">Edit</button>
                                                @endif
                                            </div>
                                        </div>

                                        
                                        @if (Auth::user()->level == 'kepsek')
                                        <div class="modal fade bd-example-modal-lg"
                                            id="examplemModal{{ $data["id"] }}" tabindex="-1" role="dialog"
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
                                                        action="{{ action('App\Http\Controllers\DispositionController@edit', $data["id"]) }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Judul Surat
                                                                            Masuk</label>
                                                                            <select class="form-control" name="kepada">
                                                                                @foreach ($alluser as $user)
                                                                                @if ($user->id == $data->kepada)
                                                                                <option value="{{ $user->id }}" selected>
                                                                                @endif
                                                                                @if ($user->id != $data->kepada)
                                                                                <option value="{{ $user->id }}" >
                                                                                    
                                                                                @endif
                                                                                {{ $user->name }} ({{ $user->level }})</option>
                                                                                @endforeach
                                                                            </select>  
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            

                                                            
                                                            
                                                            <div class="form-group">
                                                                <label form="exampleInputEmail1">Isi Surat</label>
                                                                <textarea class="form-control" rows="3" name="isi_disposisi" >{{ $data->isi_disposisi }}</textarea>
                                                            </div>


                                                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-outline-success mr-2">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                </div>

                </a>
                </td>




                                    {{-- <td style="text-align: center">
                                        
                                                @if (Auth::user()->level == 'tatausaha')
                                                <a type="button" onclick="confirmasi({{ $data->id }})"><button
                                                    class="btn btn-outline-danger">Hapus</button>
                                                </a>
                                                @endif
                                        </a>
                                    </td> --}}
                                </tr>
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
@endsection

