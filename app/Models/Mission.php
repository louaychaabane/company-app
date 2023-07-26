<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $table = 'missions';

    // Define the fillable fields
    protected $fillable = [
        'id_employee',
        'start_date',
        'end_date',
        'description',
    ];
}
