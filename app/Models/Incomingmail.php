<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomingmail extends Model
{
    use HasFactory;
    protected $fillable = ['no_sm','judul_sm','id_type','asal_surat','tgl_masuk','perihal_sm','file_sm','isi_sm',
    'pengirim_sm','mark'];
}
