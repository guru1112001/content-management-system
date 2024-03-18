<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showContents(Folder $folder)
    {
        $contents = $folder->contents;
        return view('contents.index', compact('contents'));
    }
}
