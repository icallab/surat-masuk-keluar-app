@extends('layouts.dashboard')
@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @if (Auth::user()->level == 'kepsek' || Auth::user()->level == 'tatausaha')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $suratmasuk }}</h3>

                                <p>Surat Masuk</p>
                                
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="{{ route('surat_masuk') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $suratkeluar }}</h3>

                                <p>Surat Keluar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <a href="{{ route('surat_keluar') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    
                    @if (Auth::user()->level == 'kepsek')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $disposisi}}</h3>
                                <p>Disposisi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                            <a href="{{ route('disposisi') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <!-- ./col -->
                    @if (Auth::user()->level !== 'kepsek')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $disposisimasuk }}</h3>
                                <p>Disposisi Masuk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                            <a href="{{ route('disposisi') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif

                    
                  
                    
                </div>
            </div>
        </section>
    </div>
@endsection
