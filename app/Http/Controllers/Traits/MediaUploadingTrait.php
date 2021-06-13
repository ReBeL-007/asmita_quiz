<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait MediaUploadingTrait
{
    public function storeMedia(Request $request)
    {
// Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }

// If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('app/public/tmp/uploads');
        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }
        $ckpath = storage_path('app/public/uploads/ckeditor');
        try {
            if (!file_exists($ckpath)) {
                mkdir($ckpath, 0755, true);
            }
        } catch (\Exception $e) {
        }

        if($request->file('file') != NULL){
            $file = $request->file('file');
            $name = uniqid() . '_' . trim($file->getClientOriginalName());

            $file->move($path, $name);

            return response()->json([
                'url'           => asset('/storage/tmp/uploads/'.$name),
                'name'          => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }else{
            $file = $request->file('upload');
            $name = uniqid() . '_' . trim($file->getClientOriginalName());

            $file->move($ckpath, $name);

            return response()->json([
                'url'           => asset('/storage/uploads/ckeditor/'.$name),
                'name'          => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }


    }
}
