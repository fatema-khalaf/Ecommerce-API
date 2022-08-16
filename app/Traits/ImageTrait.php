<?php
namespace App\Traits;

use Carbon\Carbon;
use Image;

trait ImageTrait{

    function saveImage($image, $folder, $width = 1017, $height=1000){
        $name_gen = hexdec(uniqid()) . hexdec(uniqid())  ."." . $image->getClientOriginalExtension();
        Image::make($image)->resize($width, $height)->save('api/v1/upload/'.$folder.'/' . $name_gen);
        $saveName = '/upload/'.$folder.'/'.$name_gen;
        return $saveName;
    }

    function updateImage($oldImage ,$newImage, $folder){
        @unlink('api/v1'.$oldImage); // @ means if the file exist delete it, if not skip this line 
        $name_gen = hexdec(uniqid()) . hexdec(uniqid())  ."." . $newImage->getClientOriginalExtension();
        Image::make($newImage)->resize(1017, 1000)->save('api/v1/upload/'.$folder.'/' . $name_gen);
        $saveName = '/upload/'.$folder.'/'.$name_gen;
        return $saveName;
    }
}

?>