<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseModel;


class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'id',
        'name',
        'class',
        'address',
        'gender',
        'subject',
        'created_at',
        'updated_at',
    ];
    public function subjectid()
{
    return $this->hasOne(CourseModel::class, 'id','subject');
}
}
