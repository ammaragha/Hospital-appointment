<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table= 'reservations';
    protected $fillable = [
        'user_id','special_id','date','time','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class,'sepcial_id');
    }
}
