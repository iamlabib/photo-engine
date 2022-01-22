<?php

namespace Labib\PhotoEngine;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoEngineController extends Controller
{
    public $path;
    public $type;
    public $height;
    public $width;
    public $imageSource;
    public $imageType;
    
    public function __construct(){
        $this->height = 300;
        $this->width = 400;  
        $this->imageSource = 0;           
    }

    public function getParams($request){            
        if(!isset($request->src)){
            $this->placeholder(400, 300, 'No filepath given');
            die('No filepath given');
        } else {
            if(!file_exists($request->src)){
                $this->placeholder(400, 300, 'File not found');
                die('File not found');
            }
            $this->path = $request->src;
        }
        if(!isset($request->type)){
            $this->type = 'jpg';
        } else {
            $this->type = $request->type;
        }
    }

    public function getImageType(){
        $imageExtention = array_reverse(explode('.', $this->path));
        if(sizeof($imageExtention) > 0){
            return $imageExtention[0];
        }
        else {
            $this->placeholder(400, 300, 'Unsupported format');
            die('Unsupported format');
        }
    }

    public function setImageSource(){
        switch ($this->imageType) {
            case 'png':
                $this->imageSource = imagecreatefrompng($this->path);
                break;
            case 'jpg':
                $this->imageSource = imagecreatefromjpeg($this->path);
                break;
            case 'jpeg':
                $this->imageSource = imagecreatefromjpeg($this->path);
                break;
            default:
                $this->imageSource = imagecreatefromjpeg($this->path);
                break;
        }
        
        if(!$this->imageSource){
            die('file not found');
        }
    }  

    public function index(){
        echo "Alhamdulillah for everything";
    }



    public function placeholder($width, $height, $text = null){
        $image = imagecreate($width, $height);
        imagecolorallocate($image, 0, 153, 0);    
        $text_color = imagecolorallocate($image, 255, 255, 255);
        
        if(!$text){
            $text = $width . " X " . $height;
        }        
        imagestring($image, 5, ($width/2) - 40, ($height/2)-30,  $text, $text_color);
        imagestring($image, 3, ($width/2) - 80, ($height/2),  "Powered by - PhotoEngine", $text_color);
        
        Header('Content-Type: image/png');
        Imagejpeg($image);
    }

    public function render(Request $request, $quality){
        if(!$request->has('src')){
            if(!$request->has('width') || !$request->has('height')){
                $this->placeholder(400, 300, '400 X 300');
            } else {
                $this->placeholder($request->width, $request->height, $request->width. ' X ' . $request->height);
            }            
        }

        $this->getParams($request);
        $this->imageType = $this->getImageType();  
        $this->setImageSource();     

        $x = imagesx($this->imageSource);
        $y = imagesy($this->imageSource);
        if($request->has('width') || $request->has('height')){
            $this->width = $request->width;
            $this->height = $request->height;
        } 
        $source = imagecreatetruecolor($this->width, $this->height);
        imagecopyresampled($source, $this->imageSource, 0, 0, 0, 0, $this->width, $this->height, $x, $y);
        Header('Content-Type: image/png');
        Imagejpeg($source);

    }
}
