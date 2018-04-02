<h2 class="hk">Join our website member</h2>
<div align="center">
   <form id="simple-form" style="width: 680px;" name="myform" method="post" action="/<?php echo I_N; ?>reg"  >
      <table style="padding:5px;">
         <tr>
            <td><label for="input-1">Name</label></td>
            <td><input id="username" size="20" type="text" name="username" class="user_name" ></td>
            <td>
               <div><span class="check"  ></span></div>
            </td>
         </tr>
         <tr>
            <td><label for="input-2">Pass</label></td>
            <td><input id="password1" input size="20" type="password" name="password1" class="user_psw"></td>
            <td>
               <div><span class="checkpsw"></span></div>
            </td>
         </tr>
         <tr>
            <td><label for="input-2">Confirmpass</label></td>
            <td><input id="password2" input size="20" type="password" name="password2" class="user_psw1"></td>
            <td>
               <div><span class="checkpsw1"></span></div>
            </td>
         </tr>
         <tr>
            <td><label for="input-2">E-mail</label></td>
            <td><input id="email" size="20" type="text" name="email" class="user_email"></td>
            <td>
               <div><span class="checkemail"></span></div>
            </td>
         </tr>
         <tr>
            <td><label for="input-2" ><img src="/inctxt/captcha.php"></label></td>
            <td><input type="text" name="code" id="code" class="user_code"></td>
            <td>
               <div><span class="checkcode"  ></span></div>
            </td>
         </tr>
         <tr>
            <td><label for="input-2" ><input type="checkbox" name="fruit" value ="apple" onClick="checkform();"></label></td>
            <td  style="font-family:Arial;padding:8px;margin:8px;font-weight:600;">&nbsp;sure all is ok</td>
            <td></td>
         </tr>
         <tr>
            <td><label for="input-2"></label></td>
            <td><input type="submit" name="Submit" id="Submit" value="JOIN" style="font-family:Arial;" disabled></td>
         </tr>
      </table>
   </form>
</div>
