<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;

class M_jabatan extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_jabatan';
    protected $guarded = [];
    public $timestamps = true;

    public function pegawais()
    {
        return $this->hasMany(M_pegawai::class, 'id_jabatan', 'id');
    }
}
