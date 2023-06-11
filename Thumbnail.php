<?php

namespace Serenity\Image;

use Exception;

class Thumbnail {
    protected $original;
    protected $originalWidth;
    protected $originalHeight;
    protected $basename;
    protected $imageType;
    protected $messages = [];

    public function __construct(
        string $image,
        protected string $path,
        protected int $max = 120,
        protected string $suffix = '_thb' ){
            if(is_file($image) && is_readable($image)){
                $dimensions = getimagesize($image);
            } else {
                throw new Exception("Cannot open image");
            }

            if(!is_array($dimensions)){
                throw new Exception("$image doesn't appear to be an image");
            } else {
                if($dimensions[0] == 0){
                    throw new Exception("Cannot determine size of $image");
                }
                if(!$this->checkType($dimensions['mime'])){
                    throw new Exception("Cannot process this file type");
                }
            }
            if(is_dir($path)&&is_writable($path)){
                $this->path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR;
            } else {
                throw new Exception("Cannot write to $path");
            }

            $this -> original = $image;
            $this -> originalWidth = $dimensions[0];
            $this->originalHeight = $dimensions[1];
            $this->basename = pathinfo($image, PATHINFO_FILENAME);
            $this->max = abs($max);
            if($suffix != '_thb'){
                $this->suffix = $this->setSuffix($suffix) ?? '_thb';
            }
        }

    protected function checkType($mime){
        $mimetypes = ['image/jpeg', 'image/png', 'image/gif', 'image/wehp', 'image/jpg'];
        if(in_array($mime, $mimetypes)){
            $this->imageType = substr($mime, strpos($mime, '/')+1);
            return true;
        }
        return false;
    }  

    protected function setSuffix($suffix){
        if(preg_match('/^\w+/', $suffix)){
            if(!str_starts_with($suffix, '_')){
                return "_" . $suffix;
            }else {
                return $suffix;
            }
        }
    }

    public function test() {
        $values = <<<END
        <pre>
        File: $this->original
        Original Width: $this->originalWidth
        Original Height: $this->originalHeight
        Base name: $this->basename
        Image type: $this->imageType
        Max: $this->max
        Path: $this->path
        Suffix: $this->suffix
        </pre>
        END;
        echo $values;
        if($this->messages){
            print_r($this->messages);
        }
    }
}
