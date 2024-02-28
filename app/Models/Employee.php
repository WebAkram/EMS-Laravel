<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'document',
        'department',
        'jobrole',
        'cnic',
        'dateofbirth',
        'dateofissue',
        'dateofexpiry',
        'user_id',
    ];
    public $timestamps = true;


}
