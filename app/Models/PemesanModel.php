<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EventModel;

class PemesanModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_pemesan';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    
    public function event()
    {
        return $this->belongsTo(EventModel::class,'id_user');
    }
}
