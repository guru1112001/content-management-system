<?php
// app\Models\Content.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['folder_id', 'file_name', 'file_path','published'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
    protected $casts = [
        'published' => 'boolean',
    ];
}
