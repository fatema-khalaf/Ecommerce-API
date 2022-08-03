<?php
namespace App\Traits;

use Carbon\Carbon;
use Image;

trait ImageTrait{

    function saveImage($image, $folder){
        $name_gen = hexdec(uniqid()) . hexdec(uniqid())  ."." . $image->getClientOriginalExtension();
        Image::make($image)->resize(1017, 1000)->save('api/v1/upload/'.$folder.'/' . $name_gen);
        $saveName = '/upload/'.$folder.'/'.$name_gen;
        return $saveName;
    }

    function updateImage($oldImage ,$newImage, $folder){

        // $imgNameArray = explode("/",$oldImage);
        // $imgName = end($imgNameArray);
        unlink( 'api/v1'.$oldImage);
        
        $name_gen = hexdec(uniqid()) . hexdec(uniqid())  ."." . $newImage->getClientOriginalExtension();
        Image::make($newImage)->resize(1017, 1000)->save('api/v1/upload/'.$folder.'/' . $name_gen);
        $saveName = '/upload/'.$folder.'/'.$name_gen;
        return $saveName;
    }
}

?>