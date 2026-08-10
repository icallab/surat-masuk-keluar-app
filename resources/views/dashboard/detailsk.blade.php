@extends('layouts.dashboard')
@section('content')

<section class="content">


            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Surat</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered" style="width: 100%">
                           
                            <tbody>
                                <tr>

                                    <td>Pengirim</td>
                                    <td>
                                        {{ App\Models\User::where('id', $detail->pengirim_sk)->value('name') }}
                                    </td>

                                </tr>
                                
                                <tr>

                                    <td style="width: 30%">Kepada</td>
                                    <td>
                                    @if (!App\Models\user::where('id', $detail->kepada)->value('name'))
                                        {{ $detail->kepada_external }}
                                    @endif
                                    @if (App\Models\user::where('id', $detail->kepada)->value('name'))
                                            {{ App\Models\user::where('id', $detail->kepada)->value('name') }}
                                    @endif
                                    </td>

                                </tr>
                                <tr>

                                    <td>Nomor Surat Keluar</td>
                                    <td>
                                        {{ $detail->no_sk }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Judul Surat Keluar</td>
                                    <td>
                                        {{ $detail->judul_sk }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Tipe Surat</td>
                                    <td>
                                        {{ App\Models\Type::where('id', $detail->id_type)->value('type') }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Tujuan Surat</td>
                                    <td>
                                        {{ $detail->tujuan_surat}}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Tanggal</td>
                                    <td>
                                        {{ $detail->tgl_keluar }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Perihal Surat keluar</td>
                                    <td>
                                        {{ $detail->perihal_sk }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>File Surat Keluar</td>
                                    <td>
                                        {{ $detail->file_sk }}
                                        <a href="{{ route('open_surat_keluar', $detail->file_sk) }}" class="btn btn-primary btn-sm" target="_blank"><i
                                            class="fa fa-eye"></i>&nbsp;&nbsp;lihat</a>
                                    </td>

                                </tr>
                                <tr>

                                    <td>Isi Surat Keluar</td>
                                    <td>
                                        {{ $detail->isi_sk }}
                                    </td>

                                </tr>
                                
                                <tr>

                                    <td>Status</td>
                                    <td>
                                        @if ($detail->status == 'disetujui')
                                            <span class="badge badge-success">Surat {{ $detail->status }}</span>
                                        @elseif ($detail->status == 'ditolak')
                                            <span class="badge badge-danger">Surat {{ $detail->status }}</span>
                                        @elseif ($detail->status == 'belum')
                                            <span class="badge badge-warning">{{ $detail->status }} dikonfirmasi</span>
                                        @endif
                                    </td>

                                </tr>
                                

                                <tr>
                                <td>Keterangan</td>
                                    <td>
                                        {{ $detail->keterangan }}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>  

                     {{-- <div class="row">

                        <div class="col-md-3 ml-auto">
                 @if (Auth::user()->level == 'kepsek')
                            <button class="btn btn-outline-primary btn-block" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false"
                                aria-controls="collapseExample">Disposisi</button>
                                @endif
                        </div>
                    </div> --}}
                                {{-- <tr>

                                    <td>Tanggal</td>
                                    <td>
                                        {{ $detail->created_at }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Dari</td>
                                    <td>
                                        {{ App\Models\User::where('id', $detail->mail_from)->value('name') }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Kepada</td>
                                    <td>
                                        {{ App\Models\User::where('id', $detail->mail_to)->value('name') }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Kode Surat</td>
                                    <td>
                                        {{ $detail->mail_code }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Tipe Surat</td>
                                    <td>
                                        {{ App\Models\Type::where('id', $detail->id_type)->value('type') }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Pesan</td>
                                    <td>
                                        {!! nl2br(e($detail->description)) !!}
                                    </td>

                                </tr>
                                <tr>

                                    <td>File</td>
                                    <td>
                                        &nbsp;&nbsp;{{ $detail->file_name }}<br>
                                        <a href="{{ route('download', $detail->file_name) }}" class="btn btn-primary btn-sm"
                                            download=""><i class="fa fa-download"></i>&nbsp;&nbsp;Download</a>
                                        <a href="{{ route('open_surat', $detail->id) }}" class="btn btn-primary btn-sm"
                                            target="_blank"><i class="fa fa-eye"></i>&nbsp;&nbsp;lihat</a>
                                    </td>

                                </tr>
                            

                    --}}







                    {{-- @if (!$dis)
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form action="{{ route('tambah_disposisi') }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="from-group">
                                        <label for="exampleInputEmail1">Penerima</label>
                                        <select class="form-control" name="user">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pesan</label>
                                        <textarea class="form-control" rows="10" name="pesan"></textarea>
                                    </div>

                                    <input type="hidden" name="id_sm" value="{{ $detail->id }}">
                                    <button type="submit" class="btn btn-info btn-block">kirim</button>
                                </form>
                            </div>
                        </div>
                    @endif --}}
                    

                </div>
                
            </div>
        </div>
    @endsection
