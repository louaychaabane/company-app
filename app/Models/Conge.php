<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;
    
    protected $table = 'conge';

    // Define the fillable fields
    protected $fillable = [
        'id_employee',
        'start_date',
        'end_date',
        'description',
        'status',
    ];
}
