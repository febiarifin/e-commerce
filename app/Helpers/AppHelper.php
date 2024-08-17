<?php

namespace App\Helpers;

class AppHelper{

    public static function upload_file($file, $path)
    {
        if ($file){
            $file_path = $file->store($path, 'public');
            return 'storage/'.$file_path;
        }
    }

    public static function delete_file($file)
    {
        if ($file){
            if (file_exists(public_path($file))){
                unlink(public_path($file));
            }
        }
    }

}
