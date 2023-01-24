<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CourseModel extends Model
{
    use HasFactory;
    protected $table = 'course';
    protected $fillable = [
        'id',
        'code',
        'name',
        'created_at',
        'updated_at',
    ];
}
