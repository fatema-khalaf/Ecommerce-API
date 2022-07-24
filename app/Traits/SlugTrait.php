<?php
namespace App\Traits;

trait SlugTrait{

    function makeSlug($value){
        $slug = strtolower(str_replace(str_split('\\/:*?"<>| '), "-", $value));  // remove all these chars as they cause problems in routing 'URL'
        return $slug;
    }
}

?>