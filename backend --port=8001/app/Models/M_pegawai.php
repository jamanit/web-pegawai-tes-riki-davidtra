<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;

class M_pegawai extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_pegawai';
    protected $guarded = [];
    public $timestamps = true;

    public function jabatan()
    {
        return $this->belongsTo(M_jabatan::class, 'id_jabatan', 'id');
    }
}
