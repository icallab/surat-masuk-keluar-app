@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Surat Masuk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Surat Masuk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-default">

                <div class="card-body">
                                              
                           
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="label">Tanggal Awal</label>
                                            <input type="date" name="tglawal" class="form-control"
                                                id="tglawal" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="label">Tanggal Akhir</label>
                                            <input type="date" name="tglakhir" class="form-control"
                                                id="tglakhir" >

                                        </div>
                                    </div>
                                    <div class="col-mb-3">
                                    <a href="" onclick="this.href='/laporan-masuk-pertanggal/'+ document.getElementById('tglawal').value +
                                    '/'+ document.getElementById('tglakhir').value"  
                                    target="_blank" class="btn btn-primary" >Cetak</a>
                                    </div> 
                                    
                                </div>
                            

                            </div><!-- /.container-fluid -->


                        </div>
                    
                </div>
            </section>
            </div>
        
        </div>
    
    </div>
    
                



                        {{-- 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css" /> --}}
                    @endsection
                  