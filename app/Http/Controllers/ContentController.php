<?php
use App\Models\Content;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


class FileDownloadController extends Controller
{
    public function download($id): StreamedResponse
    {
        $file = Content::findOrFail($id); // Assuming 'id' is the identifier of the file record

        if (!Storage::exists($file->file_path)) {
            abort(404);
        }

        return Storage::download($file->file_path, $file->file_name);
    }
}
