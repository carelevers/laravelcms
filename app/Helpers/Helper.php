<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{

    public static function moveImage($image){
        $name = $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/posts');
        $imagePath = $destinationPath . "/" . $name;
        $image->move($destinationPath, $name);
        return $name;
    }
}
