<!DOCTYPE HTML>
<html>
   <head>
      <meta charset="UTF-8">
      <title>福彩3D</title>
       <!-- <meta http-equiv="content-type" content="text/html; charset=utf-8" /> -->  
      <meta name="keywords" content="福彩3D" />
      <meta name="description" content="福彩3D" />
      <link rel="icon" type="image/png" href="/pic/favicon.ico" />
      <link rel="stylesheet" href="/inctxt/css/c5.css" />

      
        <?php if (isset($m) && $m == 'usersetavatar' || $m == 'image_crop_demo' || $m == 'user') {   ?>  
      <link rel="stylesheet" href="/inctxt/css/crop.css" />
        <?php } ?>          
        <!--
      [if IE]> 
      <style>      
      .alb_box{display:inline;}
      .smilies{border-collapse:collapse;width:600px}.smilies td.smilie{text-align:center;vertical-align:middle;padding:6px;width:82px;height:82px;border:1px solid #1e5c99}.smilies td.smilienav{text-align:right;padding:5px 0 5px 0}.smilies td A{color:#00f}.smilieimg{max-width:80px;max-height:80px;width:expression(this.width>81 ? 80:true);height:expression(this.height>81 ? 80:true);border:0}.smilieimg_large{max-width:150px;max-height:150px;width:expression(this.width>151 ? 150:true);height:expression(this.height>151 ? 150:true);border:0}
      </style>
      <script src=http://html5shiv.googlecode.com/svn/trunk/html5.js></script>
        <![endif]-->    
   </head>
   <body>
      <div class="wrapper">
         <!-- website content start -->
         
         
<div class="header"> <!-- header start -->
<div id="topleft"></div>		 
<div id="logo"><img src="/pic/1444572094_732568.png" height="111"   width="264" alt="logo"></div>
<div id="topright">
	<?php
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
?>
<table><tr><td id='b'><a href="/<?php
    echo I_N;
?>register">Register</a></td><td>&nbsp;|&nbsp;</td><td id='a'><a href="/<?php
    echo I_N;
?>loginform" >Login</a></td></tr></table>  
<?php
} else {
?><table><tr><td>
<a href="/<?php
    echo I_N;
?>user"><?php
    echo $_SESSION['username'];
?></a></td><td>&nbsp;|&nbsp;</td><td><a href="/<?php
    echo I_N;
?>logout">Logout</a></td></tr></table>
<?php
}
?>
</div> 
</div><!-- header end -->      
         <div class="colmask rightmenu">
            <div class="colleft">
               <div class="col1">
                  <!-- Column 1 start -->
                  <div id="frs_nav" class="frs_nav_1">
                     <div id="frs_nav_wrap" class="nav_wrap">
                        <ul class="nav_left">
                           <li class="focus" id="ecs"> <a href="/">3D</a></li>
                           <li class="divide">|</li>
                           <li class="download"><a  href="/<?php echo I_N;?>calendar">Calendar</a></li>
                           <li class="divide">|</li>
                           <li class="contact"><a  href="/<?php echo I_N;?>contact" >Contact</a></li>
                           <li class="divide">|</li>
                        </ul>
                        <ul class="nav_center"><li class=" first"> <?php if (isset($m) && $m == 'view') { ?>
                         <a href="#sub" class="icon_add_post diff_tab" title="Post"  id="add_post_btn">&nbsp;Reply</a> 
                         <?php } else { ?> 
                        <a href="/#sub" class="icon_add_post diff_tab" title="Post"  id="add_post_btn">New post&nbsp;</a>  <?php } ?></li> 
                        </ul>
       
                        <ul class="nav_right">
                           <li class=" first"> <a class="nav_icon refresh" id="refresh" href="/">F5</a></li>
                        </ul>
                     </div>
                  </div>
                  <div id="loading"><img class="ajax-loader" src="/pic/ajax-loader-sm.gif" alt="loading..." /></div>    
                  <div id='main-content'>         
					         
                                <?php
                                if (isset($act_content)) {
                                    echo $act_content;
                                }                                                               
                                 else {
                                    include 'inctxt/' . $m . '.php';
                                }
                                ?>      
                                             
                   </div>
                  <!-- Column 1 end -->
               </div>
               <div class="col2">
                  <!-- Column 2 start -->
                <?php  include 'inctxt/aside.html';  ?> 
                 <!-- Column 2 end -->
               </div>
            </div>
         </div>
         <!-- website content end -->
         <div class="push"></div>
      </div>
      <div class="footer">
         <a href="http://code.google.com/p/mimvic/"> Powered By MiMViCbbs3 </a>
         <span class="cfoot">Copyright &copy;2009 - 2012 </span> 
         <a href="<?php echo 'http://'.$_SERVER ['HTTP_HOST'].'/'; ?>"><?=WEBTITLE.'&nbsp;'?></a>All Rights Reserved!
      </div>    



      <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
      <script type="text/javascript" src="/inctxt/js/jquery.simplyscroll.min.js"></script>
      <script type="text/javascript" src="/inctxt/js/top.js"></script>
      <script type="text/javascript">
         (function ($) {
             $(function () {
                 $("#scroller").simplyScroll();
             });
         })(jQuery);
      </script>
     
  
   
<script type="text/javascript" src="/inctxt/js/jquery.Jcrop.js"></script>
<script type="text/javascript" src="/inctxt/js/cropsetup.js"></script>
<script>
    $(function () {
        $("input[type=file]").change(function () {
            $(this).parents(".uploader").find(".filename").val($(this).val());
        });
        $("input[type=file]").each(function () {
            if ($(this).val() == "") {
                $(this).parents(".uploader").find(".filename").val("No file selected...");
            }
        });

        $('input:file').change(
            function () {
                if ($(this).val()) {
                    $('input:submit').attr('disabled', false);

                }
            });
    });
</script>
      <script type="text/javascript">var uux="/index.php/check";</script><script type="text/javascript" src="/inctxt/js/chk.js"></script>
      <script src="/inctxt/js/jquery.treeview.js" type="text/javascript"></script>    
      <script type="text/javascript">
            $(document).ready(function(){
                $("#browser").treeview({
                    collapsed: true,
                    animated: "normal"
                });
            });            
      </script> 
 

   



<script src="/inctxt/js/jquery.localScroll.min.js" type="text/javascript"></script> 
<script src="/inctxt/js/jquery.scrollTo.min.js" type="text/javascript"></script> 
<script type="text/javascript">
$(function () {
  $('ul.nav_center').localScroll({duration:800});
});
</script>
 
	
	<script type="text/javascript">
$(function() {
  function makePreview() {
    input = $('#input').val().replace(/</g, "&lt;").replace(/>/g, "&gt;");
    $('#preview').html(input);
    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"preview"]);
  }
  $('body').keyup(function(){makePreview()});
  $('body').bind('updated',function(){makePreview()});
  makePreview();
});
</script>





   </body>
</html>
