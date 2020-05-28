<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta_event';

    protected $primaryKey = 'id_peserta';
}
