<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedFormation extends Model
{
    use HasFactory;
    protected $fillable = ['id_formation', 'id_employee','start_date'];
}
