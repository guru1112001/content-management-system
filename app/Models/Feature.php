<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $casts = [
        'list_routes' => 'array',
    ];

    protected $fillable = [
        'name',
        'super_admin',
        'admin',
        'member',
        'list_routes',
    ];
}
