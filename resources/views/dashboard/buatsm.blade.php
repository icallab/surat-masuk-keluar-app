@extends('layouts.dashboard')
@section('content')
 
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Surat Masuk</h1>
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
                            <form class="needs-validation" novalidate action="{{ route('tambah_surat_masuk') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor Surat Masuk</label>
                                            <input type="text" name="no_suratmasuk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                            
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Judul Surat Masuk</label>
                                            <input type="text" name="judul_suratmasuk" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                </div>
    

                                <div class="row">
                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tipe Surat</label>
                                            <select class="form-control" name="tipe"required>
                                                @foreach ($types as $data)
                                                <option value="{{ $data['id'] }}">{{ $data['type'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Asal Surat</label>
                                            <input type="text" name="asal_suratmasuk" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp"required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Masuk</label>
                                            <input type="date" name="tgl_suratmasuk" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="dd-mm-yyyy" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Perihal</label>
                                            <input type="text" name="perihal_suratmasuk" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label form="exampleInputEmail1">Isi Surat</label>
                                    <textarea class="form-control" rows="3" name="isi_suratmasuk" required></textarea>
                                </div>
                                
                               
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Lampiran</label>
                                    <input type="file" name="file_sm" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" accept="application/pdf" required>
                                </div>
                                
                                
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


           
        </section>
    @endsection



