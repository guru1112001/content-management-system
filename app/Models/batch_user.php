<?php

namespace App\Models;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class batch_user extends Model
{
    use HasFactory;
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
