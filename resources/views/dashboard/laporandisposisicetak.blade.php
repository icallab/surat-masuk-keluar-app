<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Disposisi</title>
      <!-- DataTables -->
<link rel="stylesheet" type="text/css" href="style.css">
     
</head>
<body>
    <div id="left-col"> <img src="image/smk.png" style="width:100px;height:100px;" alt=""></div>
    <div id="centre-col" style="text-align: center; "><h3 >SMK Negeri 1 Tanjung Palas</h3>
        <h4 >Laporan Disposisi dari {{ $tglawal }} s/d {{ $tglakhir }}</h4></div>
    
    <section class="content">
        <div class="">
            <div class="row">
            
               
                
              </div>
            
            
        </div>
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-hover ">
                        <thead style="border: 1px solid black;">
                            <tr class="text-primary" >
                                <th>Nomor Surat</th>
                                <th>Judul Surat</th>
                                <th>Tanggal</th>
                                <th>Kepada</th>
                                <th style="width: 20%">Isi Disposisi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cetaklaporandisposisi as $disposition)
                                <tr>
                                    <td>{{ App\Models\incomingmail::where('id', $disposition->id_sm)->value('no_sm') }}</td>
                                    {{-- (App\Models\user::where('id', $outgoingmail->kepada)->value('name')) --}}
                                    <td>{{ App\Models\incomingmail::where('id', $disposition->id_sm)->value('judul_sm') }}</td>
                                    <td>{{ $disposition->created_at }}</td>
                                    <td>{{ (App\Models\user::where('id', $disposition->kepada)->value('name')) }}
                                    <td>{{ $disposition->isi_disposisi }}</td>
                                    {{-- <td>{{ $incomingmail->asal_surat }}</td> --}}
                                    {{-- <td>{{ App\Models\User::where('id', $mail->mail_from)->value('name') }}</td> --}}
                                    {{-- <td>{{ App\Models\User::where('id', $mail->mail_to)->value('name')}}</td> --}}
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
    </section>
    <script src="Adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="Adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="Adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="Adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="Adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="Adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="Adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="Adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="Adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="Adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="Adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="Adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="Adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="Adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
        });
    });
</script>
</body>
</html>