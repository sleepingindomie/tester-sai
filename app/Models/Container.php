<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'bl', 'container_no', 'seal_no', 'outer_quantity', 'outer_package_type', 'gross_weight', 'gross_meas', 'net_weight'
    ];

    protected $table = 'container'; 
}
