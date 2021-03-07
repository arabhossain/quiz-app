<?php

namespace App\Http\Controllers;

use App\TempMedia;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request){
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = str_replace(' ', '-',$file->getClientOriginalName());
            $folder = uniqid().'-'.now()->timestamp;
            $file->storeAs('temp/'.$folder, $fileName);

            TempMedia::create([
                'filename' => $fileName,
                'folder'    => $folder
            ]);

            return $folder;
        }
        return  '';
    }

    public function delete(Request $request){

        $file = TempMedia::where('folder', $request->getContent())->get();
        if ($file->isEmpty())
            return false;

        $filePath = storage_path("app/temp/".$file->first()->folder.'/'.$file->first()->filename);

        if (file_exists($filePath)) {
            unlink($filePath);
            rmdir(storage_path("app/temp/" . $file->first()->folder));
        }

        $file->first()->delete();

        return true;
    }
}
