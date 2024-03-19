<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;


class ContentController extends Controller
{
    public function preview($file)
    {
        $filePath = 'public\storage\content_files\01HRT6BXS582S5KFTJQXW5F6XA.pdf'; // Assuming the files are stored in the public/storage/content_files directory
        // echo($filePath);
        // ddd($filePath);
        // Check if the file exists
        // if (!file_exists($filePath)) {
        //     abort(404); // File not found
        // }
        
        // Determine the file type
        // $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        // If it's not a PDF, abort
       
        
        // Serve the PDF file with read-only headers
        return response()->file($filePath);
    }
    
}
