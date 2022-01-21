<?php

namespace Labib\PhotoEngine;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoEngineController extends Controller
{
    public function index(){
        echo "Alhamdulillah for everything";
    }

    public function placeholder($width, $height, $text){
        $image = imagecreate($width, $height);
  
        // Set the background color of image
        $background_color = imagecolorallocate($image, 0, 153, 0);
        
        // Set the text color of image
        $text_color = imagecolorallocate($image, 255, 255, 255);
        
        // Function to create image which contains string.
        imagestring($image, 5, ($width/90), 100,  $text, $text_color);
        imagestring($image, 3, 160, 120,  "Powered by - PhotoEngine", $text_color);
        
        Header('Content-Type: image/png');
        Imagejpeg($image);
    }
}
