<?php
$TotalRows=$total;
$TotalPages=ceil($TotalRows/$PageSize);$str = '';
if(isset($_GET["showPage"]))
{
$showPage=intval($_GET["showPage"]);
}
else
{
$showPage=1;
}
$CurrentLocation = '';                
if(I_N == ''){$CurrentLocation = substr($_SERVER["PHP_SELF"], 10);}
else{$CurrentLocation = $_SERVER["PHP_SELF"];}
if($showPage > 1){
$ss = $showPage-1;
$str = "<a href=\"$CurrentLocation?showPage={$ss}\">[Prev]</a>";
}
if($TotalPages==1){}
else if($showPage==1&&$TotalPages>1){
$str = 1;
for($p=2;$p<=5&&$p<=$TotalPages;$p++){
$str.="<a href=\"$CurrentLocation?showPage=$p\">[$p]</a>";
}}
else if($showPage<=5){
for($p=1;$p<=4+$showPage&&$p<=$TotalPages;$p++){
if($p==$showPage){
$str.="[$p]";
}else{
$str.="<a href=\"$CurrentLocation?showPage=$p\">[$p]</a>";
}}}else if($showPage>5) {
for($p=$showPage-5;$p<=$showPage+4&&$p<=$TotalPages;$p++){
if($p==$showPage){
$str.="[$p]";
 }else{
$str.="<a href=\"$CurrentLocation?showPage=$p\">[$p]</a>";
 }}}
if(($showPage < $TotalPages)&&($TotalPages<>1)){
$s = $showPage+1;
$str.="<a href=\"$CurrentLocation?showPage={$s}\">[Next]</a>";
 }
?>