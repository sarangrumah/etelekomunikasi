<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'vw_list_izin';

    /**
     * Get all persyaratan (requirements) for this Izin.
     */
    public function persyaratan()
    {
        return $this->hasMany(\App\Models\Admin\Persyaratan::class, 'id_trx_izin', 'id_izin');
    }
}
