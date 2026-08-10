<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoingmail extends Model
{
    use HasFactory;
    protected $fillable = ['no_sk','judul_sk','id_type','tujuan_surat','tgl_keluar','perihal_sk','file_sk','isi_sk','pengirim_sk',
    'status', 'keterangan','kepada','kepada_external'];
}
