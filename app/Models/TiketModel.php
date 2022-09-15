<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EventModel;

class TiketModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_tiket';

    protected $guarded = [];

    public function pemesan()
    {
        return $this->belongsTo(User::class,'id_pemesan');
    }
    
    public function event()
    {
        return $this->belongsTo(EventModel::class,'id_event');
    }
}
