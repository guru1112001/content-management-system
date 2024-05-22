<?php

namespace App\Models;

use App\Models\User;
use App\Models\Batch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchUser extends Model
{
    use HasFactory;
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
