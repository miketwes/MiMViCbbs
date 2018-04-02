<?php
  $Prve=strtolower($_SERVER['HTTP_REFERER']);
  $Onpage=strtolower($_SERVER["HTTP_HOST"]);
  $Onnym=strpos($Prve,$Onpage);
   if(!$Onnym) exit("<script language='javascript'>alert('非法操作！');history.go(-1);</script>");
$uptypes=array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png');


$UpPath = "/upload";
$max_file_size=15000; //上传文件大小限制, 单位BYTE
$pathpre="./../../upload";
$destination_folder="/"; //上传文件路径
$authnum=rand()%10000;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ 
   if (!is_uploaded_file($_FILES["file"]['tmp_name'])){//是否存在文件
       echo "<script language=javascript>alert('请先选择你要上传的文件！');history.go(-1);</script>";
       exit();
   }
   $file = $_FILES["file"];

   if(!in_array($file["type"], $uptypes)){//检查文件类型
       echo "文件类型不符!".$file["type"];
       exit();
   }

   if(!file_exists($pathpre.$destination_folder)){ 
       mkdir($pathpre.$destination_folder);
   }

   $filename=$file["tmp_name"];
   $image_size = getimagesize($filename);
   $pinfo=pathinfo($file["name"]);
   $ftype=$pinfo['extension'];
   $destination = $pathpre.$destination_folder.time().$authnum.".".$ftype;

   if(!move_uploaded_file ($filename, $destination)){ 
       echo "<script language=javascript>alert('移动文件出错！');history.go(-1);</script>";
       exit();
   }

   $pinfo=pathinfo($destination);
   $fname=$pinfo['basename'];
   
   $picture_name = $UpPath.$destination_folder.$fname;
   echo "<script language=javascript>\r\n";
   echo "window.parent.document.getElementById('picture').value='$picture_name';\r\n";
   echo "window.location.href='upload.php';\r\n";
   echo "</script>\r\n";
}
?>
