<?php

namespace Labib\PhotoEngine;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoEngineController extends Controller
{
    public function index(){
        echo "Alhamdulillah for everything";
    }

    public function placeholder($width, $height, $text = null){
        $image = imagecreate($width, $height);
        imagecolorallocate($image, 0, 153, 0);    
        $text_color = imagecolorallocate($image, 255, 255, 255);
        
        $text = $width . " X " . $height;
        // Function to create image which contains string.
        imagestring($image, 5, ($width/2) - 40, ($height/2)-30,  $text, $text_color);
        imagestring($image, 3, ($width/2) - 80, ($height/2),  "Powered by - PhotoEngine", $text_color);
        
        Header('Content-Type: image/png');
        Imagejpeg($image);
    }
}
