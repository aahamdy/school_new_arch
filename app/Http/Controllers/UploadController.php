<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Helpers\UploadHelper;
use Validator;

class UploadController extends Controller {

   
    public function __construct() {

    }

    public function uploadImage(Request $request) {
        $validator = Validator::make($request->all(), [
                    'file' => 'required|mimes:jpeg,jpg,png'
        ]);
        if ($validator->fails()) {
            return response()->json(["error_code" => 3, "message" => $validator->errors()->all()], 400);
        }
        
        return UploadHelper::uploadFile($request, 'file', '/subDirectory');
        
    }
    
}
