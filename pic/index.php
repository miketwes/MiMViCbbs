<?php 

if(isset($_POST['submit'])) 
{


$Path = $_POST["FILENAME"];
if (file_exists($Path)){
    if (unlink($Path)) {   
        echo "success";
        header('Location: http://3d.gdk.mx/pic/'.$Path);
    } else {
        echo "fail";    
    }   
} else {
    echo "file does not exist";
}


}
else{

 ?>

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><script src="Login_files/ca-pub-9153409599391170.html"></script><script async="" src="Login_files/analytics.js"></script><script defer="defer" src="Login_files/a_002"></script>               
	<title></title>
		<meta charset="utf-8">
		<link href="Login_files/style.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href="Login_files/css.css" rel="stylesheet" type="text/css">
		<!--//webfonts-->
<script type="text/javascript" charset="utf-8" src="Login_files/a"></script><script type="text/javascript" charset="utf-8" src="Login_files/a_003"></script><script type="text/javascript" id="82ac324e455efd0ecd2e73d22d852758" src="Login_files/a_004"></script><script type="text/javascript" charset="utf-8" src="Login_files/a"></script></head>
<body>
<script src="Login_files/jquery.js"></script>
<script async="" type="text/javascript" src="Login_files/fancybar.js" id="_fancybar_js"></script>
<style type="text/css">  .adsense_fixed{position:fixed;bottom:-8px;width:100%;z-index:999999999999;}.adsense_content{width:720px;margin:0 auto;position:relative;background:#fff;}.adsense_btn_close,.adsense_btn_info{font-size:12px;color:#fff;height:20px;width:20px;vertical-align:middle;text-align:center;background:#000;top:4px;left:4px;position:absolute;z-index:99999999;font-family:Georgia;cursor:pointer;line-height:18px}.adsense_btn_info{left:26px;font-family:Georgia;font-style:italic}.adsense_info_content{display:none;width:260px;height:340px;position:absolute;top:-360px;background:rgba(255,255,255,.9);font-size:14px;padding:20px;font-family:Arial;border-radius:4px;-webkit-box-shadow:0 1px 26px -2px rgba(0,0,0,.3);-moz-box-shadow:0 1px 26px -2px rgba(0,0,0,.3);box-shadow:0 1px 26px -2px rgba(0,0,0,.3)}.adsense_info_content:after{content:'';position:absolute;left:25px;top:100%;width:0;height:0;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid #fff;clear:both}.adsense_info_content #adsense_h3{color:#000;margin:0;font-size:18px!important;font-family:'Arial'!important;margin-bottom:20px!important;}.adsense_info_content .adsense_p{color:#888;font-size:13px!important;line-height:20px;font-family:'Arial'!important;margin-bottom:20px!important;}.adsense_fh5co-team{color:#000;font-style:italic;}</style>
<script>

    $(function() {
      $('.adsense_btn_close').click(function() {
        $(this).closest('.adsense_fixed').css('display', 'none');
      });

      $('.adsense_btn_info').click(function() {
        if ($('.adsense_info_content').is(':visible')) {
          $('.adsense_info_content').css('display', 'none');
        } else {
          $('.adsense_info_content').css('display', 'block');
        }
      });

    });

  </script>




	<!---728x90--->
				 <!-----start-main---->
				<div class="login-form">
				
					<div class="head">
						<img src="Login_files/mem2.jpg" alt="">
						
					</div>
				<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
					<li>
						<input class="text" name="FILENAME" value="FILENAME" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'FILERNAME';}" type="text"><a href="#" class=" icon user"></a>
					</li>
					
									 <!-----start
					<li>
						<input value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" type="password"><a href="#" class=" icon lock"></a>
					</li>--->
					<div class="p-container">
								<!-----<label class="checkbox"><input name="checkbox" checked="checked" type="checkbox"><i></i>Remember Me</label> -->
								
								
								<input name="submit" value="DEL" type="submit">
							<div class="clear"> </div>
					</div>
					
				</form>
			</div>
			<!--//End-login-form onclick="myFunction()"  -->
			<!---728x90--->

		 		

</body></html>



<?php } ?>
