<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showContents(Folder $folder)
    {
        $contents = $folder->contents;
        return view('contents.index', compact('folder','contents'));
    }
    public function show(Folder $folder)
    {
        // $folder = Folder::findOrFail($folderId);
        $contents = $folder->contents; // Assuming you have a relationship set up

        return view('folders.show', compact('folder', 'contents'));
    }
}
