<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $timestamp = true;

    protected $keyType = 'string';

    protected $primaryKey = 'stu_id';

    public function school() {
        return $this->belongsTo(School::class);
    }
}
