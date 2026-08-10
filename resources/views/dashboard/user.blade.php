@extends('layouts.dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manajemen User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="card-deck">
                <div class="card col-lg-12 px-0 mb-4">
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="post" action="{{ route('tambah_user') }}">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" name="username" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Level</label>
                                        <select class="form-control" name="level">
                                            <option value="kepsek">Kepala Sekolah</option>
                                            <option value="Kurikulum">Kurikulum</option>
                                            <option value="tatausaha">Tata Usaha</option>
                                            <option value="Kesiswaan">Kesiswaan</option>
                                            <option value="humas">Hubungan Masyarakat</option>
                                            <option value="sarpras">Sarana dan Prasarana</option>
                                            <option value="Guru">Guru</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-warning mr-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h2>Daftar User</h2>
                    <div class="card table-responsive p-0">
                        <div class="card-header">

                            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

                            <table id="myTable" class="table table-head-fixed text-nowrap" width="100%">
                                <thead>
                                    <tr class="text-primary">
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th style="text-align: center">Tindakan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $users)
                                        <tr class="">
                                            <td>{{ $users['name'] }}</td>
                                            @if ($users['level'] != 'kepsek' && $users['level'] != 'tatausaha')
                                                <td>{{ $users['level'] }}</td>
                                            @endif
                                            @if ($users['level'] == 'kepsek')
                                                <td>Kepala Sekolah</td>
                                            @endif
                                            @if ($users['level'] == 'tatausaha')
                                                <td>TAS</td>
                                            @endif
                                            <td style="text-align: center">
                                                <button type="button" class="btn btn-outline-warning mr-2"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal{{ $users->id }}">Edit</button>
                                                <div class="modal fade" id="exampleModal{{ $users->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    User</h5>
                                                                <button type="button" class="Kembali" data-dismiss="modal"
                                                                    aria-label="Kembali">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ action('App\Http\Controllers\UserController@edit', $users->id) }}"
                                                                method="post">
                                                                {{ csrf_field() }}
                                                                {{ method_field('PUT') }}
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nama</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" value="{{ $users->name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Username</label>
                                                                        <input type="text" class="form-control"
                                                                            name="username" value="{{ $users->username }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Password</label>
                                                                        <input type="password" class="form-control"
                                                                            name="password" >
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for="exampleInputEmail1">Level</label>
                                                                    <select class="form-control"  name="level" value="{{ $users-> level }}" >
                                                                        <option value="Kepala Sekolah">
                                                                            Kepala Sekolah</option>
                                                                        <option value="Kurikulum">
                                                                            Kurikulum</option>
                                                                        <option value="Tata Usaha">
                                                                            Tata Usaha</option>
                                                                        <option value="Kesiswaan">
                                                                            Kesiswaan</option>
                                                                        <option value="humas">
                                                                            sarpras</option>
                                                                        <option value="sarpras">
                                                                            Guru</option>
                                                                        <option value="Guru">
                                                                            Guru</option selected>
                                                                          
                                                                    </select>
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
                                                href="{{ route('hapus_user', $users->id) }}"
                                                        class="btn btn-outline-danger"> 
                                                        Hapus
                                                    
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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