<?php

namespace Helpers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class UploadHelper
{

    public static function uploadFile(Request $request, $fileName, $subDirectory)
    {
        if (Input::hasFile($fileName)) {
            $file = Input::file($fileName);
            $path = Input::get('path');

            $destinationPath = public_path() . "/uploads" . $subDirectory. $path;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time() . '_' . $name;
            if ($file->move($destinationPath, $filename)) {
                $filePath = "uploads" . $subDirectory .$path . '/' . $filename;
                return $filePath;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

}