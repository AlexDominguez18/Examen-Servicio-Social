<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','codigo','carrera','creditos_cursados','correo'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

}
