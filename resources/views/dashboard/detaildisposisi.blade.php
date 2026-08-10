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
                                @if (Auth::user()->level == 'kepsek')
                                <tr>

                                    <td style="width: 30%">Pengirim</td>
                                    <td>
                                        {{ App\Models\User::where('id', $detail->pengirim_sm)->value('name') }}
                                    </td>

                                </tr>
                                @endif

                               
                                <tr>
                                    
                                    <td style="width: 30%">Kepada</td>
                                    <td>
                                        {{ App\Models\User::where('id', $detail_disposisi->kepada)->value('name') }}
                                    </td>

                                </tr>
                              
                                <tr>

                                    <td>Subjek Surat</td>
                                    <td>
                                        {{ $detail->no_sm }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Judul Surat Masuk</td>
                                    <td>
                                        {{ $detail->judul_sm }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Tipe Surat</td>
                                    <td>
                                        {{ App\Models\Type::where('id', $detail->id_type)->value('type') }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Asal Surat</td>
                                    <td>
                                        {{ $detail->asal_surat}}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Tanggal Surat Masuk</td>
                                    <td>
                                        {{ $detail->tgl_masuk }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>Perihal Surat Masuk</td>
                                    <td>
                                        {{ $detail->perihal_sm }}
                                    </td>

                                </tr>
                                <tr>

                                    <td>File Surat Masuk</td>
                                    <td>
                                        &nbsp;&nbsp;{{ $detail->file_sm }}
                                        <a href="{{ route('open_surat_masuk', $detail->file_sm) }}" class="btn btn-primary btn-sm" target="_blank"><i
                                            class="fa fa-eye"></i>&nbsp;&nbsp;lihat</a>
                                    </td>

                                </tr>
                                <tr>

                                    <td>Isi Surat Masuk</td>
                                    <td>
                                        {{ $detail->isi_sm }}
                                    </td>

                                </tr>
                                
                                <tr>

                                    <td>Isi Disposisi</td>
                                    <td>
                                        <span class="badge badge-success">{{ $detail_disposisi->isi_disposisi }}</span>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>  

                     
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






                </div>
            </div>
</section>
    @endsection
