@extends('layouts.dashboard')
@section('content')
 
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Surat Keluar</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Buat Surat</li>
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
                            <form class="needs-validation" novalidate action="{{ route('tambah_surat_keluar_external') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                
                                
            
                                
                                <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kepada</label>
                                <input type="text" name="kepada_keluar_external" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor Surat Keluar</label>
                                            <input type="number" name="no_surat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Judul Surat Keluar</label>
                                            <input type="text" name="judul_suratkeluar" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                </div>
    

                                <div class="row">
                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tipe Surat</label>
                                            <select class="form-control" name="tipe">
                                                @foreach ($types as $data)
                                                <option value="{{ $data['id'] }}">{{ $data['type'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tujuan Surat</label>
                                            <input type="text" name="tujuan_suratkeluar" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Keluar</label>
                                            <input type="date" class="form-control"
                                                name="tgl_keluar" required
                                                >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Perihal</label>
                                            <input type="text" name="perihal_suratkeluar" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label form="exampleInputEmail1">Isi Surat</label>
                                    <textarea class="form-control" rows="3" name="isi_keluar" required></textarea>
                                </div>
                                
                               
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Lampiran</label>
                                    <input type="file" name="file_sk" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                </div>







                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection



