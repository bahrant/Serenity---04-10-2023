<?php

use Serenity\Image\Thumbnail;

if(isset($_GET['img'])){
    require_once("Thumbnail.php");
    try{
        $thumb = new Thumbnail($_GET['img'], 
            'C:\uploads\images\thumbs');
        $thumb->test();
    } catch (Throwable $t){
        echo $t -> getMessage();
    }
}