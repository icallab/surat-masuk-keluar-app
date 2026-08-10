@extends('layouts.dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buat Tipe Surat</h1>
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tipe Surat</li>
                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->

        </div><!-- /.container-fluid -->


    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-default">

                <div class="card-body">

                    <div>
                        <form class="needs-validation" novalidate method="post" action="{{ route('tambah_tipe') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Buat Tipe Surat</label>
                                <input type="text" class="form-control" name="type" required>
                            </div>
                            <button type="submit" class="btn btn-info mr-2">Buat</button>
                        </form>
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        {{-- <div class="card-deck">

                    <div class="card-body">
                        <div class="row">
                            <table class="col-md-3">
                                <h5>Tipe Surat</h5>
                        </div>
                    </div> --}}
                    
        <div class="container-fluid">
            <h3>Tipe Surat</h3>
            <div class="card card-default">
                <div class="card-body">
                   
                    
                
                   
                        
                        <div class="table-responsive">
                            <table id="myTable" class="table table-head-fixed text-nowrap" style="width:100%">
                                <thead>
                                    <tr class="text-primary">
                                        <th>Tipe Surat</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($type as $tipe)
                                        <tr class="">
                                            <td>{{ $tipe['type'] }}</td>

                                            <td>
                                                <button type="button" class="btn btn-outline-success mr-2"
                                                    data-toggle="modal"
                                                    data-target="#examplemModal{{ $tipe->id }}">Edit</button>
                                                <div class="modal fade" id="examplemModal{{ $tipe->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="examplemModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="examplemModalLabel">Edit Tipe
                                                                </h5>
                                                                <button type="button" class="Kembali" data-dismiss="modal"
                                                                    aria-label="Kembali">
                                                                    <span aria-hidden="true">Close</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ action('App\Http\Controllers\TypeController@edit', $tipe->id) }}"
                                                                method="post">
                                                                {{ csrf_field() }}
                                                                {{ method_field('PUT') }}
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Tipe Surat</label>
                                                                        <input type="text" class="form-control"
                                                                            name="type" value="{{ $tipe->type }}">
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
                                                <a  onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini ?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                href="{{ route('hapus_tipe', $tipe->id) }}"
                                                        class="btn btn-outline-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                </div>

            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
