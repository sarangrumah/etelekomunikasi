<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'tb_trx_persyaratan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Add relationships if needed in the future
}