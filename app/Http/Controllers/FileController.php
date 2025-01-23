<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    //

    public function downloadPrivateFile($filename)
    {
        $filename = str_replace("bukti/", "", $filename);

        $path = storage_path('app/private/bukti/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

}
