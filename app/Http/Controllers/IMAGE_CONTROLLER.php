<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class IMAGE_CONTROLLER extends Controller
{
    public static function upload_single($file, $path)
    {
        if(!file_exists($path)){
            mkdir($path.'/org',0777,true);
            mkdir($path.'/50x50',0777,true);
            mkdir($path.'/200x150',0777,true);
            mkdir($path.'/300x300',0777,true);
        }
        $name = (time() * rand(1, 99)) . '.' . $file->getClientOriginalExtension();
        Image::make($file)->save($path . '/org' . "/" . $name);
        Image::make($file)->resize(50, 50)->save($path . '/50x50' . "/" . $name);
        Image::make($file)->resize(200, 150)->save($path . '/200x150' . "/" . $name);
        Image::make($file)->resize(300, 300)->save($path . '/300x300' . "/" . $name);
        return $name;
    }



    public static function delete_image($image_name, $path)
    {
        if (file_exists(storage_path('app/' . $path . '/org/' . $image_name))) {
            unlink(storage_path('app/' . $path . '/org' . "/" . $image_name));
        }
        if (file_exists(storage_path('app/' . $path . '/50x50/' . $image_name))) {
            unlink(storage_path('app/' . $path . '/50x50' . "/" . $image_name));
        }
        if (file_exists(storage_path('app/' . $path . '/200x150/' . $image_name))) {
            unlink(storage_path('app/' . $path . '/200x150' . "/" . $image_name));
        }
        if (file_exists(storage_path('app/' . $path . '/300x300/' . $image_name))) {
            unlink(storage_path('app/' . $path . '/300x300' . "/" . $image_name));
        }
    }


    public static function upload_multiple($request_files, $path)
    {
        $counter = 1;
        $images = array();
        foreach ($request_files as $file) {
            $name = time() * rand(1, 99) * $counter . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save($path . '/org' . "/" . $name);
            Image::make($file)->resize(50, 50)->save($path . '/50x50' . "/" . $name);
            Image::make($file)->resize(200, 150)->save($path . '/200x150' . "/" . $name);
            Image::make($file)->resize(300, 300)->save($path . '/300x300' . "/" . $name);
            $images[] = $name;
            $counter++;
        }
        return $images;
    }
}
