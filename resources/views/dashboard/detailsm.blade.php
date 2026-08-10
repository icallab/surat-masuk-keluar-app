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

                                <td style="width: 30%">Pengirim</td>
                                <td>
                                    {{ App\Models\User::where('id', $detail->pengirim_sm)->value('name') }}
                                </td>

                            </tr>

                            <tr>

                                <td>Nomor Surat Masuk</td>
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
                                    {{ $detail->asal_surat }}
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
                                    <a href="{{ route('open_surat_masuk', $detail->file_sm) }}"
                                        class="btn btn-primary btn-sm" target="_blank"><i
                                            class="fa fa-eye"></i>&nbsp;&nbsp;lihat</a>
                                </td>

                            </tr>
                            <tr>

                                <td>Isi Surat Masuk</td>
                                <td>
                                    {{ $detail->isi_sm }}
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>


                <div class="row">
                    <div class="container">
                        <div class="col-md-3 ml-auto">
                            @if (Auth::user()->level == 'kepsek')
                                <button class="btn btn-outline-primary btn-block" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">Disposisi</button><br>
                            @endif
                        </div>
                    </div>
                </div>

                @if (!$dis)
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form class="needs-validation" novalidate action="{{ route('tambah_disposisi') }}" method="post">
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
                                    <textarea class="form-control" rows="10" name="pesan" required></textarea>
                                </div>

                                <input type="hidden" name="id_sm" value="{{ $detail->id }}">
                                <button type="submit" class="btn btn-info btn-block">kirim</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
