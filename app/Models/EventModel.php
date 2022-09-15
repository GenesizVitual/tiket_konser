<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TiketModel;

class EventModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_event';

    protected $guerded = [];

    public function getTiket()
    {
        return $this->hasMany(TiketModel::class,'id_event','id');
    }
}
