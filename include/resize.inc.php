<? 
function resize($oldfile,$newfile,$width,$height) { 
	$tmp = split(".",$oldfile);
	$tmp = $tmp[1];

	$imgInfo = getimagesize($oldfile);
 	if($imgInfo[2] == 3){
	 
		$imagen=imagecreatefrompng($oldfile); 
		
		/*$x=imageSX($imagen); 
		$y=imageSY($imagen);*/ 
	
		$newImg = imagecreatetruecolor($width, $height);
		imagealphablending($newImg, false);
		imagesavealpha($newImg,true);
		$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
		imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
		imagecopyresampled($newImg, $imagen, 0, 0, 0, 0, $width, $height, $imgInfo[0], $imgInfo[1]);
	
		imagepng($newImg,$newfile);  
	
		imagedestroy($newImg);  
		imagedestroy($imagen);  
	} 
}

function chmod_R($path, $filemode) { 
    if (!is_dir($path)) return chmod($path, $filemode); 
    $dh = opendir($path); 
    while (($file = readdir($dh)) !== false) { 
        if($file != '.' && $file != '..') { 
            $fullpath = $path.'/'.$file; 
            if(is_link($fullpath)) 
                return FALSE; 
            elseif(!is_dir($fullpath)) 
                if (!chmod($fullpath, $filemode)) 
                    return FALSE; 
            elseif(!chmod_R($fullpath, $filemode)) 
                return FALSE; 
        } 
    } 
    closedir($dh); 
    if(chmod($path, $filemode)) 
        return TRUE; 
    else 
        return FALSE; 
} 
?>