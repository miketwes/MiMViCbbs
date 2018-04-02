<?php

function resizeImage($image, $width, $height, $scale, $ext)
{
    $newImageWidth  = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage       = imagecreatetruecolor($newImageWidth, $newImageHeight);
    if ($ext == 2) {
        $source = imagecreatefromjpeg($image);
    } elseif ($ext == 1) {
        $source = imagecreatefromgif($image);
    } else {
        $source = imagecreatefrompng($image);
    }
    
    imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);
    imagejpeg($newImage, $image, 100);
    chmod($image, 0777);
    return $image;
}

    extract($_FILES["file"]);
    $ext       = pathinfo(strtolower($name), PATHINFO_EXTENSION);
    $to        = "upload/tmp_" . time() . '.' . $ext;
    $max_width = 500;
    $error_array = array(
        'UPLOAD_ERR_OK',
        'UPLOAD_ERR_INI_SIZE : The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        'UPLOAD_ERR_FORM_SIZE : The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        'UPLOAD_ERR_PARTIAL  : The uploaded file was only partially uploaded.',
        'UPLOAD_ERR_NO_FILE : No file was uploaded.',
        'UPLOAD_ERR_NO_TMP_DIR : Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.',
        'UPLOAD_ERR_CANT_WRITE : Failed to write file to disk. Introduced in PHP 5.1.0.',
        'UPLOAD_ERR_EXTENSION : File upload stopped by extension. Introduced in PHP 5.2.0.'
    );
    
    if ( !in_array($ext, array('jpg', 'jpeg', 'png', 'gif') ) || $size > 1048576 ) {
		
        al('ONLY jpeg images under 1MB are accepted for upload'.$ext);
    }
    
    if ($error > 0) {
        
        al($error_array[$error]);
    }
    
    if (!isset($_FILES["file"]) || empty($name)) {
		
        al('Please choose a file to upload');
    }
    
    if (!file_exists($tmp_name) || !is_uploaded_file($tmp_name)) {
		
        al('No upload');
    }
    
    move_uploaded_file($tmp_name, $to);
    chmod($to, 0777);
    
    if (($a = getimagesize($to)) === false) {
        unlink($to);
        al('not a image type');
    }
    
    if ($a[2] > 3) {
        al('type error');
    }
    
    $width  = $a[0];
    $height = $a[1];
    
    if ($width > $max_width) {
        $scale = $max_width / $width;
    } else {
        $scale = 1;
    }
    
    $uploaded = resizeImage($to, $width, $height, $scale, $a[2]);
   

?>


   <div id="crop">

    <img src="/<?= $uploaded; ?>" id="target" alt="[Jcrop Example]" />

    <div id="preview-pane">
      <div class="preview-container">
        <img src="/<?= $uploaded; ?>" class="jcrop-preview" alt="Preview" />
      </div>
    </div><!-- @end #preview-pane -->
    
    <div id="form-container">
      <form id="cropimg" name="cropimg" method="post" action="/<?php echo I_N;?>usersetavatar">      
              <input type="hidden" id="x" name="x">
              <input type="hidden" id="y" name="y">
              <input type="hidden" id="w" name="w">
              <input type="hidden" id="h" name="h">
              <input type="hidden" id="target" name="uploaded" value="<?= $uploaded; ?>">
              <input type="submit" id="submit" value="Crop Image!">
      </form>
    </div><!-- @end #form-container -->
 
  </div><!-- @end div crop --> 
