<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait ProcessFiles 
{
    public function storePicture(Request $request, $name, $oldFileName)
    {
        if ($request->hasFile($name)) {
            $pathFile = config('setting.folderUpload') . $oldFileName;
            if (File::exists($pathFile)) {
                File::delete($pathFile);
            }

            $file = $request->file($name);
            $newFileName = time() . rand(1, 1000) . '.'. $file->getClientOriginalExtension();
            $file->move(config('setting.folderUpload'), $newFileName);
            
            return $newFileName;
        }
            
        return $oldFileName;
    }

    public function storeAudio(Request $request, $name, $oldFileName)
    {
        if ($request->hasFile($name)) {
            $pathFile = config('setting.folderUpload') . $oldFileName;
            if (File::exists($pathFile)) {
                File::delete($pathFile);
            }

            $file = $request->file($name);
            $newFileName = time() . rand(1, 1000) . '.'. $file->getClientOriginalExtension();
            $file->move(config('setting.folderUpload'), $newFileName);
            
            return $newFileName;
        }
            
        return $oldFileName;
    }
}
