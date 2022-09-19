<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'specialities';

    protected $fillable = [
        'name', 'description'
    ];


    public function doctors()
    {
        return $this->hasMany(Doctor::class,'special_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'special_id');
    }
}
