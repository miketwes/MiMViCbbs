<?php
if (extension_loaded('zlib')) {
    ob_end_clean();
    ob_start('ob_gzhandler');
}
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Asia/Chongqing');
$filename = '.htaccess';
if (file_exists($filename)) {
    define('I_N', '');
} else {
    define('I_N', 'index.php/');
}
define('BASE_URL', '/');


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function ip($str)
{
    $ip  = explode(".", $str);
    $str = $ip[0] . '.' . $ip[1] . '.' . $ip[2] . '.*';
    return $str;
}

$ip = getRealIpAddr();

if (ip($ip) == '5.39.219.*') {
    
    header("Location: " . BASE_URL);
    exit;
}

define('WEBTITLE', 'Mimvicbbs');
$A_D = "admin";

if (!empty($_SERVER['HTTP_USER_AGENT']) && !isset($ua)) {
    $ua = $_SERVER['HTTP_USER_AGENT'];
}

$functions   = array(
    'main',
    'view',
    'msgtoyou',
    'save',
    'reg',
    'login',
    'activate',
    'check',
    'register',
    'loginform',
    'calendar',
    'contact',
    'pics',
    'gamelist',
    'playgame',
    'funnygif'
);
$u_functions = array(
    'logout',
    'user',
    'usr_post',
    'usr_reply',
    'user_p_r',
    'usersetavatar',
    'usersaveavatar',
    'vote'
    
);

include 'inctxt/pdo.php';
$db = new \ThinPdo\db('sqlite:site.db');    


$url_this = '';

if (isset($_SERVER['ORIG_PATH_INFO'])) {
    $path_o = $_SERVER['ORIG_PATH_INFO'];
} elseif (isset($_SERVER['PATH_INFO'])) {
    $path_o = $_SERVER['PATH_INFO'];
}

if (!isset($path_o) || $path_o == '/') {
    
    $m = 'main';
    
} else {
    
    $url_this   = $path_o;
    $path_r_arr = explode("/", $path_o);
    $m          = $path_r_arr[1];
    if (isset($path_r_arr[2]) && $path_r_arr[2] !== NULL) {
        $id = $path_r_arr[2];
    }
    if (isset($path_r_arr[3]) && $path_r_arr[3] !== NULL) {
        $cid = $path_r_arr[3];
    }
}


if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $_SESSION['u'] = 'log';
}
if (isset($_SESSION['u']) && strcmp($_SESSION['username'], $A_D) == 0) {
    $_SESSION['admin'] = 'log';
}
if (!isset($_SESSION['member'])) {
    $_SESSION['member'] = $db->select('users', 'COUNT(username)', '', '', '1');
}

/*
function html($input)
{
    return array_map(create_function('$str', 'return htmlentities($str,ENT_QUOTES);'), $input);
}
*/

function html($input)
{
   // if (!is_array($input) {return false;}
    function filterStr($str) {

        return htmlentities($str, ENT_QUOTES);

    }
    
    $input = array_map('filterStr', $input);

    return $input;
   
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {
    $_GET = html($_GET);
}
if (get_magic_quotes_gpc()) {
    
    function stripslashes_deep($value)
    {
        $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
        return $value;
    }
    
    $_POST    = array_map('stripslashes_deep', $_POST);
    $_GET     = array_map('stripslashes_deep', $_GET);
    $_COOKIE  = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}


function al($msg = '', $path = '/')
{
    echo '<script type="text/javascript">';
    if ($msg !== '') {
        echo 'alert("' . $msg . '");';
    }
    echo 'location.href="' . $path . '" </script>';
    exit;
}

function lenth($c, $path)
{
    $temp_len = (strlen($c) + mb_strlen($c, 'utf-8')) / 2;
    if ($temp_len <= 5) {
        $msg = 'content as lest 5 !';
        al($msg, $path);
        return false;
    }
    return true;
}

function checkDateTime($data)
{
    if (date('Y-m-d', strtotime($data)) == $data) {
        return true;
    } else {
        return false;
    }
}

if (!isset($_SESSION['admin'])) {
    
    
    if (!isset($_SESSION['u'])) {
        
        if (in_array($m, $u_functions)) {
            $g    = 'This is member area pls login!';
            $path = '/' . I_N . 'loginform';
            al($g, $path);
            
        } elseif (!in_array($m, $functions)) {
            $g = 'Out of range!';
            al($g);
            
        }
        
    } else {
        
        if (!in_array($m, $functions) && !in_array($m, $u_functions)) {
            $g = 'Out of range!';
            al($g);
        }
        
    }
    
}

switch ($m) {
    
    
    case 'check':
        if (isset($name)) {
            unset($username);
        }
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $username = $_POST['username'];
            $count    = $db->select("users", 'COUNT(username)', "username = ?", array(
                $username
            ), '1');
            
            $HTML = '';
            if ($count > 0) {
                $HTML = 'user exists';
            } else {
                $HTML = '';
            }
            echo $HTML;
        }
        
        if (isset($_POST['usercode']) && !empty($_POST['usercode'])) {
            if (isset($code)) {
                unset($code);
            }
            $code = $_POST['usercode'];
            
            $HTML = '';
            
            if (strtoupper($code) != $_SESSION['vercode']) {
                
                $HTML = 'user exists';
            } else {
                $HTML = '';
            }
            unset($code);
            echo $HTML;
        }
        
        break;
    
    case 'main':
        
        if (isset($_POST["q"]) && isset($_SESSION['main_page'])) {
            echo $_SESSION['main_page'];
        } else {
            
            $total    = $db->select("topic", 'COUNT(id)', '', '', 1);
            $PageSize = 50;
            include 'inctxt/page.php';
            $order  = "ORDER BY top desc, lasttime desc, id desc  limit " . (($showPage - 1) * $PageSize) . " , " . $PageSize;
            $pg     = $db->select('topic', '*', '', '', '', $order);
            $total1 = $db->select("content", 'COUNT(cid)', '', '', 1);
            
            $jpq = '
                     <div class="frs_good_nav_main_1">
                        <div class="frs_good_nav_wrap"><span class="good_zone"><a href="#%21/n">精品区</a>：</span><span><a href="#%21/n/c1">原创精品</a></span><span><a href="#%21/n/c2">学习心得</a></span><span><a href="#%21/n/c3">类库分享</a></span></div>
                     </div>';
            
            $th = '
                     <div id="thread_list" class="thread_list">
                        <table id="thread_list_table" class="thread_list_table">
                           <thead>
                              <tr>
                                 <th class="c2"></th>
                                 <th>Title</th>
                                 <th class="c3">Poster</th>
                                 <th class="c4">Tim</th>
                                 <th class="c6">Re</th>
                                 <th class="c5">Last post</th>
                              </tr>
                           </thead>';
            
            $tc = '';
            
        if(is_array($pg) && !empty($pg)){  
            
            foreach ($pg as $topic) {
                $ggl = $ggbb = $icc = $icc1 = '';
                $id  = $topic['id'];
                $ti  = $topic['lasttime'];
                if (date('Y-m-d') == date('Y-m-d', $ti)) {
                    $v = date('H:i', $ti);
                } else {
                    $v = date('m-d', $ti);
                }
                $ico = $topic['ico'];
                if ($topic['top'] == 0 && $ico != 0) {
                    $icc = '<span class="micons" style="background-position:' . $ico . 'px 0;"></span>';
                }
                if ($topic['top'] == 1) {
                    $icc = '<span class="micons" style="background-position:-22px 0;"></span>';
                }
                if ($topic['good'] == 1) {
                    $icc1 = '<span class="micons" style="background-position:-396px 0;"></span>&nbsp;';
                }
                if ($topic['vb'] != 0 || $topic['vg'] != 0) {
                    if ($topic['vb'] == 0 && $topic['vg'] - $topic['vb'] > 2) {
                        $isg = 'g';
                    }
                    if ($topic['vg'] == 0 && $topic['vb'] - $topic['vg'] > 2) {
                        $isg = 'b';
                    }
                    if ($topic['vb'] != 0 && $topic['vg'] != 0) {
                        if ($topic['vg'] / $topic['vb'] > 2) {
                            $isg = 'g';
                        }
                        if ($topic['vb'] / $topic['vg'] > 2) {
                            $isg = 'b';
                        }
                    }
                    $ggbb = '<div class="imgteaser"><a href="#"><img class="ding_icon" src="/pic/gif/' . $isg . '.gif" width="16" height="16" alt = "vote"  />
<span class="desc">' . $topic["vg"] . ':' . $topic["vb"] . '</span></a></div>';
                }
                
                $o1 = '<a href="/' . I_N;
                $o2 = '&nbsp;</a>';
                
                if (isset($_SESSION["admin"])) {
                    $ggl = '&nbsp;<a href="/' . I_N . 'd/' . $id . '">d&nbsp;</a><a href="/' . I_N . 'update/' . $id . '">u&nbsp;</a>';
                    if ($topic['top'] == 1) {
                        $ggl .= $o1 . '0top/' . $id . '">x' . $o2;
                    }
                    if ($topic['top'] == 0) {
                        $ggl .= $o1 . '1top/' . $id . '">t' . $o2;
                    }
                    if ($topic['good'] == 1) {
                        $ggl .= $o1 . '0good/' . $id . '">y' . $o2;
                    }
                    if ($topic['good'] == 0) {
                        $ggl .= $o1 . '1good/' . $id . '">g' . $o2;
                    }
                } else {
                    $ggl = $v . "&nbsp;&nbsp;" . $topic['lastname'];
                }
                
                $tc .= '
                           <tr>
                              <td>' . $icc . '</td>
                              <td  class="thread_title"><a href="/' . I_N . 'view/' . $id . '">' . htmlspecialchars($topic['topic']) . '</a>&nbsp;' . $icc1 . $ggbb . '</td>
                              <td><div class="tp">' . $topic['name'] . '</div></td>
                              <td id="' . $id . '"><div class="tp">' . $topic['view'] . '</div></td>
                              <td><div class="tp">' . $topic['reply'] . '</div></td>
                              <td><div class="tp">' . $ggl . '</div></td>
                           </tr>';
            }
        }
            $tf = '
                        </table>
                     </div>
                     <div class="th_footer"><a href="/' . I_N . 'contact" class="btn_tousu feedback">反馈</a>主题<span class="red">' . $total . '</span>,帖子<span class="red">' . $total1 . '</span>,<a href="/">会员</a><span class="red">' . $db->select('users', 'COUNT(username)', '', '', '1') . '</span></div>
                     <br />
                     <div id="pagebar">
                        <div class="pagination">' . $str . '</div>
                     </div>';
            
            ob_start();
            include 'inctxt/main_form.txt';
            $main_form = ob_get_contents();
            ob_end_clean();
            $act_content = $jpq . $th . $tc . $tf . '<a id="sub"></a>' . $main_form;
            if (!isset($_SESSION['main_page'])) {
                $_SESSION['main_page'] = $act_content;
            }
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo $act_content;
                exit;
            } else {
                include 'inctxt/index.php';
            }
            
            
        }
        break;
    
    
    case 'view':
        $tu = $db->select('topic', 'name', 'id = ?', array(
            $id
        ), 1);
        if ($tu === 'thePROPHET' && !isset($_SESSION['u'])) {
            $g    = 'This is member area pls login!';
            $path = '/' . I_N . 'loginform';
            al($g, $path);
        }
        
        $total    = $db->select("topic", 'COUNT(id)', 'id = ?', array(
            $id
        ), 1);
        $PageSize = 20;
        include 'inctxt/page.php';
        $order      = "ORDER BY cid  limit " . (($showPage - 1) * $PageSize) . " , " . $PageSize;
        $pg         = $db->select('content', '*', 'id = ?', array(
            $id
        ), '', $order);
        $topic_name = $db->select('topic', 'topic', 'id = ?', array(
            $id
        ), 1);
        $db->exec("update topic set view=view+1 where id = '$id' ");
        $hd    = '<div id="thread_title"><h1>' . $topic_name . '</h1></div><div id="thread_title_ext"></div><div class="post">';
        $votef = '';
        if (isset($_SESSION['username'])) {
            $votef = '<form id="form"  action="/' . I_N . '>vote/' . $id . '" method="post"><table><tr><td><input name="vote" value="1" type="radio"></td><td><img class="ding_icon" src="/pic/gif/g.gif" width="16" height="16" alt ="vote" /></td><td>&nbsp;</td><td><input name="vote" value="2" type="radio"></td><td><img class="ding_icon" src="/pic/gif/b.gif" width="16" height="16" alt ="vote"  /></td><td><input type="submit" name="submit" value="vote" /></td></tr></table></form>';
        }
        $ssg = '';
        if (isset($_SESSION['errmsgvote'])) {
            $ssg = $_SESSION['errmsgvote'];
            unset($_SESSION['errmsgvote']);
        }
        $hd1  = '</div><div id="thread_footer"><ul><li>Posts: <span class="red">' . $total . '</span></li><li class="viewpagination">' . $str . '</li></ul></div><br /><br />' . $votef . $ssg . '<br />';
        $main = '';
        foreach ($pg as $con) {
            $cid  = $con['cid'];
            $adg  = '';
            $name = $con['name'];
            if (isset($_SESSION['username']) && $name == $_SESSION['username']) {
                $name = '<a href="/' . I_N . 'user">' . $name . '</a>';
            }
            if (isset($_SESSION["admin"])) {
                $adg = '&nbsp;<a href="/' . I_N . 'dr/' . $id . '/' . $cid . '">dr</a>&nbsp<a href="/' . I_N . 'ur/' . $id . '/' . $cid . '">ur</a>';
            }
            $main .= '<table><tbody><tr><td class="author" id="autonym"  valign="top"><ul><li><a class="user-image" href="/" style="background-image: url(/upload/' . $con['img'] . ')" title="avatar">avatar</a></li><li class="name">' . $name . '</li></ul></td><td class="content" valign="top"><p class="floor">' . $cid . '#</p><br /><div style="width:expression(parentNode.offsetWidth);overflow:auto;overflow-y:hidden;">' . $con['content'] . '</div></td></tr><tr><td colspan="2" class="info gray"><ul><li>' . date('Y-m-d H:i', $con['time']) . '</li><li>' . $adg . '&nbsp;</li></ul></td></tr></tbody></table><div class="post_split"><div class="split_line"></div></div>';
        }
        
        
        ob_start();
        include 'inctxt/view_form.txt';
        $view_form = ob_get_contents();
        ob_end_clean();
        
        $act_content = $hd . $main . $hd1 . '<a id="sub"></a>' . $view_form;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo $act_content;
        } else {
            include 'inctxt/index.php';
        }
        
        
        break;
    
    
    
    
    case 'save':
        
        if (isset($_SESSION['admin'])) {
            
            $cont = trim($_POST['content']);
            if ($db->exec($cont)) {
                al('ok');
            } else {
                al('fail');
            }
            
            
        }
        
        if (isSet($_POST['newpost_x']) || isSet($_POST['reply_x'])) {
            
            
            $time = time();
            if (isSet($_SESSION["post_time"])) {
                
                if (($time - $_SESSION["post_time"]) < 3) {
                    al('pls wait!', '/');
                }
                
            } else {
                
                $ip1 = explode('.', $ip);
                $ip3 = $ip1[0] . '_' . $ip1[1] . '_' . $ip1[2] . "%";
                
                $lastposttime = $db->select('pageview', 'MAX(time)', "ip like ? and page like '%save%' ", array(
                    $ip3
                ), 1);
                
                if (($time - $lastposttime) < 3) {
                    al('pls wait!', '/');
                }
            }
            
            
            
            if (isSet($_POST['newpost_x'])) {
                $path = '/#sub';
            } else {
                $path = '/' . I_N . 'view/' . $id . '#sub';
            }
            $ver = $_POST['code'];
            if ($ver != $_SESSION["vercode"] || $_SESSION["vercode"] == '') {
                $_SESSION["errmsg"] = '<font color="red">captcha not correct!</font>';
                al('captcha not correct!', $path);
            }
            
            $cont = trim($_POST['content']);
            lenth($cont, $path);
            $time = time();
            $xn   = ip($ip);
            if (!isset($_SESSION['username'])) {
                $name = $xn;
                $t    = 1;
            } else {
                $name = $_SESSION['username'];
                $t    = $db->select('users', 'avatar', 'username = ?', array(
                    $name
                ), 1);
            }
                        
            if (isSet($_POST['newpost_x'])) {
                $tp = trim($_POST["topic"]);
                lenth($tp, '/');
                $info = array(
                    'view' => 0,
                    'reply' => 0,
                    'topic' => $tp,
                    'name' => $name,
                    'lasttime' => $time,
                    'lastname' => ''
                );

                $db->insert('topic', $info);
                $id   = $db->lastInsertId();
                $info = array(
                    'id' => $id,
                    'cid' => 1,
                    'name' => $name,
                    'content' => $cont,
                    'time' => $time,
                    'img' => $t
                );
                
                try {
                $db->insert('content', $info);
                } catch (Exception $e) {
                         print $e->getMessage();
                         exit();
                }
                
                
                if (isset($_POST['iconid'])) {
                    $ico = $_POST["iconid"];
                    $db->exec("update topic set ico = '$ico' where id ='$id'");
                }
                header("Location: " . BASE_URL);
            } else {
                $Maxid = $db->select('content', 'max(cid)', 'id = ?', array(
                    $id
                ), 1) + 1;
                $info  = array(
                    'id' => $id,
                    'cid' => $Maxid,
                    'name' => $name,
                    'content' => $cont,
                    'time' => $time,
                    'img' => $t
                );
                $db->insert('content', $info);
                $db->exec("update topic set lasttime = '$time' , lastname='$name' , reply=reply+1 where id = '$id' ");
                
                header("Location: " . BASE_URL);
            }
            $_SESSION["post_time"] = $time;
        } else {
            al();
        }
        break;
    
    case 'login':
        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) && !empty($_POST['username'])) {
            $p = md5($_POST['password']);
            $u = $_POST['username'];
        } else {
            al();
        }
        
        $c1 = $db->select("users", 'COUNT(username)', "username = ? AND password = ? AND act = ? ", array(
            $u,
            $p,
            ""
        ), 1);
        
        if ($c1 > 0) {
            $_SESSION['username'] = $u;
            $_SESSION['password'] = $p;
            
            al();
        } else {
            $_SESSION['msgtoyou'] = 'username or password not correct or valid or your accout not active yet!';
            $act_content          = 'msgtoyou';
            include 'inctxt/index.php';
        }
        break;
    
    case 'logout':
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        session_unset();
        session_destroy();
        al();
        break;
    
    
    case 'msgtoyou':
        
        if (isset($_SESSION['msgtoyou'])) {
            if (is_array($_SESSION['msgtoyou']) && count($_SESSION['msgtoyou']) > 0) {
                $mc = '<ul>';
                foreach ($_SESSION['msgtoyou'] as $msg) {
                    $mc .= '<li>' . $msg . '</li>';
                }
                $mc .= '</ul>';
            } else {
                $mc = $_SESSION['msgtoyou'];
            }
        }
        
        $act_content = '<div style="font-size: 16px;font-family:Verdana;font-weight:300;
    margin-top: 55px;margin-left: 55px;text-align: left;">' . $mc . '</div>';
        unset($_SESSION['msgtoyou']);
        include 'inctxt/index.php';
        break;
    
    
    
    case 'usersetavatar':
        
        if (isset($_POST['upload'])) {
            include('inctxt/index.php');
        } elseif (isset($_POST['x'])) {
            
            $thumb_image      = "thumbnail_" . time();
            $thumb_image_name = $thumb_image;
            $u                = $_SESSION['username'];
            $targ_w           = $targ_h = 200;
            $jpeg_quality     = 100;
            $src              = $_POST['uploaded'];
            $img_r            = imagecreatefromjpeg($src);
            $dst_r            = ImageCreateTrueColor($targ_w, $targ_h);
            
            imagecopyresampled($dst_r, $img_r, 0, 0, (int) $_POST['x'], (int) $_POST['y'], $targ_w, $targ_h, (int) $_POST['w'], (int) $_POST['h']);
            imagejpeg($dst_r, 'upload/' . $thumb_image_name, $jpeg_quality);
            
            
            $db->exec("update users set avatar = '$thumb_image'  where username = '$u' ");
            $db->exec("update content set img = '$thumb_image'  where name = '$u' ");
            
            al('', '/' . I_N . 'user');
        }
        break;
    
    
    case 'user':
        
        if (isset($_SESSION['admin'])) {
            $row = $db->select('users', "*", "", "", "", 'order by time');
            
            $act_content = '    
    <table id="customers">
<tr>
  <th><a href="/' . I_N . 'show">Username</a></th>
  <th><a href="/' . I_N . 'tv">E-mail</a></th>
  <th><a href="/' . I_N . 'uploadfiles">Reg_time</a></th>
  <th><a href="/' . I_N . 'upl">Act</a></th>
</tr>';
            
            
            foreach ($row as $ro) {
                $tim = date('Y-m-d H:i:s', $ro['time']);
                $act_content .= '<tr><td>' . $ro['username'] . '&nbsp;&nbsp;<a href="/' . I_N . 'eu/' . $ro['time'] . '">u</a></td><td>' . $ro['email'] . '</td><td>' . $tim . '</td><td>' . $ro['act'] . '</td></tr>';
            }
            
            $act_content .= '</table >';
        } else {
            
            
            $username = $db->select('users', 'username', 'username = ?', array(
                $_SESSION['username']
            ), 1);
            $avatar   = $db->select('users', 'avatar', 'username = ?', array(
                $_SESSION['username']
            ), 1);
            
            
            list($u, $s) = explode(' ', microtime());
            $time     = (float) $u + (float) $s;
            $rand_num = rand(100000, 999999);
            $rand_num = rand($rand_num, $time);
            mt_srand($rand_num);
            $rand_num1 = mt_rand();
            
            
            
            $act_content = '
            
            <div style="margin-left:40px;margin-top:40px">
	<table width="200" border="0" cellspacing="0" cellpadding="0">	
  <tr>
   <td height="200">
	<a class="user-image" href="/" style="background-image: url(/upload/' . $avatar . '?' . $rand_num1 . ')" title="avatar">avatar</a>
	</td>
  </tr>
  <tr>
  
<td height="40"><div align="center">' . $_SESSION['username'] . '</div></td>
  </tr>
</table><br /><br />

 </div>
 <div align="left">Create an Avatar by Upload and Crop Image</div>
 
 <div></div><br />
 
<form action="/' . I_N . 'usersetavatar"  method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	<div class="uploader blue">
<input type="text" class="filename" readonly="readonly"/>
<input type="button" name="file" class="button" value="Browse..."/>
<input type="file" name="file" id="file" size="30">

</div>
     
     <div class="uploader blue">
     
 <input type="submit"  style="height:32px;" name="upload" value="Upload"  disabled />	
                  
    </div>

</form> ';
        }
        
        
        
        include 'inctxt/index.php';
        break;
    
    case 'reg':
        include 'inctxt/reg.php';
        break;
    
    case 'activate':
        $msg  = 'Your account is not active!';
        $path = '/' . I_N . 'register';
        if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])) {
            $email = $_GET['email'];
        } else {
            al($msg, $path);
        }
        if (isset($_GET['key']) && (strlen($_GET['key']) == 32)) {
            $key = $_GET['key'];
        } else {
            al($msg, $path);
        }
        if (isset($email) && isset($key)) {
            $stmt = $db->exec("update users set act = ''  where email = '$email' and act = '$key'");
            if (!$stmt) {
                al($msg, $path);
            } else {
                $msg  = 'Your account is now active. You may now Log in!';
                $path = '/' . I_N . 'loginform';
                al($msg, $path);
            }
        }
        break;
    
    case 'calendar':
        include 'inctxt/index.php';
        break;



    case 'pics':
        
        $x   = '<td class="smilie"><img class="smilieimg" alt="5a" src="pic/pics/';
        $y   = '.gif"></td>';
        $pe  = range(1, 48);
        $cpt = '';
        for ($i = 0; $i < 44; $i = $i + 6) {
            $cpt .= '<tr>' . $x . $pe[$i] . $y . $x . $pe[$i + 1] . $y . $x . $pe[$i + 2] . $y . $x . $pe[$i + 3] . $y . $x . $pe[$i + 4] . $y . $x . $pe[$i + 5] . $y . '</tr>';
        }
        
        $act_content = '<div id="m-content"><table class="smilies"><tbody>' . $cpt . '</tbody></table></div>';
        
        include 'inctxt/index.php';
        
        break;
    
    case 'gamelist':
        
        function swfname()
        {
            global $swf;
            $swf += 1;
            $str = '';
            $str = "<li><a href=\"/" . I_N . "playgame/{$swf}\" ><img src=\"/game/img/{$swf}.jpg\" width=\"220px\" height=\"185px\"  /></a></li>";
            return $str;
        }
        
        $swfnamel = '';
        
        for ($i = 0; $i < 3; $i++)
            $swfnamel .= swfname();
        
        $act_content = '<br /><br /><br /><div id="mainDiv"><ul>' . $swfnamel . '</ul></div>';
        
        include 'inctxt/index.php';
        break;
    
    
    
    case "playgame":
        $act_content = '<div id="m-content">
            <embed type="application/x-shockwave-flash" classid="clsid:d27cdb6e-ae6d-11cf-96b8-4445535400000" src="/game/' . $id . '.swf" wmode="opaque" quality="high" menu="false" play="true" loop="true" allowfullscreen="true" height="653" width="750"><br />
            </embed></div>';
        include 'inctxt/index.php';
        break;
    








    
    case 'vote':
        if (isset($_POST['vote'])) {
            $vvote = $_POST["vote"];
            
            $username = $_SESSION['username'];
            $stmt     = $db->select("tvote", COUNT(username), "id = ? AND username = ?", array(
                $id,
                $username
            ), 1);
            
            if ($stmt > 0) {
                $path = '/' . I_N . 'view/' . $id;
                al('one user canonly vote once!', $path);
            }
            
            if ($vvote == 1) {
                $db->exec("update topic set vg = vg+1 where id ='$id'");
                
                $info = array(
                    'id' => $id,
                    'username' => $username
                );
                $db->insert('tvote', $info);
            }
            
            if ($vvote == 2) {
                $db->exec("update topic set vb = vb+1 where id ='$id'");
                $info = array(
                    'id' => $id,
                    'username' => $username
                );
                $db->insert('tvote', $info);
            }
        }
        
        al();
        break;
    
    
    
    
    case $m == '1top' || $m == '1good' || $m == '0top' || $m == '0good':
        $rest0 = $m[0];
        $rest1 = substr($m, 1);
        $db->exec("update topic set $rest1 = $rest0 where id = '$id'");
        al();
        break;
    
    
    case 'tv':
        $sql   = "DELETE FROM  visitors";
        $stmt  = $db->query($sql);
        $sql   = "DELETE FROM pageview";
        $stmt1 = $db->query($sql);
        if ($stmt && $stmt1) {
            al('TABLE visitor and pageview has truncated!', '/');
        } else {
            al();
        }
        break;
    
    case 'eu':
        $topic = $db->select('users', '*', 'time = ?', array(
            $id
        ));
        foreach ($topic as $rows) {
        }
        
        $act_content = '    
<h2 class="hk">Eidtor User</h2>
<div align="center">
   <form id="simple-form" style="width: 420px;" method="post" action="/' . I_N . 'changeuser/' . $id . '">
      <div><label for="password1">Username</label>
         <input type="text" name="username" id="password1" value="' . $rows['username'] . '"/>
      </div>
      <div><label for="password2">Password</label>
         <input type="text" name="password" id="password2" value="' . $rows['password'] . '" />
      </div>
      <div><label for="password2">Act</label>
         <input type="text" name="act" id="password2" value="' . $rows['act'] . '" />
      </div>
      <input type="submit" name="Submit" id="Submit" value="Changeuser">
   </form>
</div>';
        
        include 'inctxt/index.php';
        break;
    
    case 'changeuser':
        $u = $_POST['username'];
        $p = $_POST['password'];
        if (strlen($p) !== 32) {
            $p = md5($p);
        }
        $act = $_POST['act'];
        $db->exec("update users set username = '$u' where time = '$id'");
        $db->exec("update users set password = '$p' where time = '$id'");
        $db->exec("update users set act = '$act' where time = '$id'");
        al();
        break;
    
    
    case 'd':
        $db->exec("delete from topic where id = '$id' ");
        $db->exec("delete from content where id = '$id' ");
        al();
        break;
    case 'u':
        extract($_POST);
        $time     = strtotime($time);
        $lasttime = strtotime($lasttime);
        if (!($img = $db->select('users', 'avatar', 'username = ?', array(
            $name
        ), 1))) {
            $img = 1;
        }
        $db->update("topic", array(
            "view" => $view,
            "reply" => $reply,
            "topic" => $topic,
            "name" => $name,
            "lastname" => $lastname,
            "lasttime" => $lasttime
        ), "id = $id");
        
        
        $cid = 1;
        
        $db->update("content", array(
            "name" => $name,
            "time" => $time,
            "img" => $img
        ), "id = $id AND cid = $cid");
        
        if (!empty($lastname)) {
            if (!($img = $db->select('users', 'avatar', 'username = ?', array(
                $lastname
            ), 1))) {
                $img = 1;
            }
            $cid  = $db->select('content', 'max(cid)', 'id = ?', array(
                $id
            ), 1);
            $name = $lastname;
            $time = $lasttime;
            
            $db->update("content", array(
                "name" => $name,
                "time" => $time,
                "img" => $img
            ), "id = $id AND cid = $cid");
        }
        al();
        break;
    
    case 'dr':
        
        $db->exec("delete from content where id = '$id' and cid = '$cid' ");
        
        if (!($Maxid = $db->select('content', 'max(cid)', 'id = ?', array(
            $id
        ), 1))) {
            $db->exec("delete from topic where id = '$id' ");
            al();
        }
        
        if ($Maxid < $cid) {
            $lasttime = $db->select('content', 'time', 'id = ? and cid = ?', array(
                $id,
                $Maxid
            ), 1);
            if ($Maxid == 1) {
                
                $db->update("topic", array(
                    "lastname" => '',
                    "lasttime" => $lasttime
                ), "id = $id");
                $db->exec("update topic set reply = 0 where id = '$id' ");
                ;
                al();
                
            } else {
                
                $lastname = $db->select('content', 'name', 'id = ? and cid = ?', array(
                    $id,
                    $Maxid
                ), 1);
                $db->update("topic", array(
                    "lastname" => $lastname,
                    "lasttime" => $lasttime
                ), "id = $id");
                $db->exec("update topic set  reply = reply - 1 where id = '$id' ");
                al();
            }
        } else {
            $db->exec("update topic set  reply = reply - 1 where id = '$id' ");
            al();
        }
        
        break;
    
    
    case 'update':
        $topic = $db->select('topic', '*', 'id = ?', array(
            $id
        ));
        foreach ($topic as $rows) {
        }
        $v  = date('Y-m-d H:i:s', $rows['lasttime']);
        $t1 = $db->select('content', 'time', 'id = ? and cid = ?', array(
            $id,
            1
        ), 1);
        $t1 = date('Y-m-d H:i:s', $t1);
        $m  = 'updatetopic';
        include 'inctxt/index.php';
        break;
    
    case 'ur':
        $con = $db->select('content', '*', 'id = ? and cid = ?', array(
            $id,
            $cid
        ));
        $m   = 'updatecontent';
        foreach ($con as $rows) {
        }
        $v = date('Y-m-d H:i:s', $rows['time']);
        include 'inctxt/index.php';
        break;
    
    case 'urc':
        
        $name = trim($_POST['rn']);
        
        if (!($img = $db->select('users', 'avatar', 'username = ?', array(
            $name
        ), 1))) {
            $img = 1;
        }
        
        $content = trim($_POST['content']);
        $time    = strtotime($_POST['tim']);
        
        $ut0 = $db->select('topic', 'lasttime', 'id = ?', array(
            $id
        ), 1);
        
        $ut1 = $db->select('content', 'time', 'id = ? and cid = ?', array(
            $id,
            $cid
        ), 1);
        
        
        if ($cid == 1) {
            $lasttime = $time;
            
            $db->update("topic", array(
                "name" => $name,
                "lasttime" => $lasttime
            ), "id = $id");
            
        }
        
        
        else {
            if ($ut1 == $ut0) {
                $lasttime = $time;
                $lastname = $name;
                
                $db->update("topic", array(
                    "name" => $name,
                    "lasttime" => $lasttime,
                    "lastname" => $lastname
                ), "id = $id");
                
            }
        }
        
        
        $db->update("content", array(
            "name" => $name,
            "content" => $content,
            "time" => $time,
            "img" => $img
            
        ), "id = $id and cid = $cid");
        
        
        al();
        break;
    
    
    
    case 'show':
        $today = strtotime(date('Y-m-d', time()));
        $rs    = $db->query("SELECT * FROM visitors where date_and_time > '$today'  ORDER BY date_and_time DESC")->fetchAll();
        
        
        
        $act_content = '<table width="100%" border="1" cellspacing="0" cellpadding="0"><th width="15%">Date</th><th width="15%">Ip</th><th width="30%">Browser</th>
<th width="20%">From</th><th width="20%">Pv</th>';
        foreach ($rs as $row):;
            
            if ($row['link'] == 1) {
                $ipa = '<a href="/' . I_N . 'showdetail/' . $row['ip_address'] . '">' . $row['ip_address'] . '</a>';
            } else {
                $ipa = $row['ip_address'];
            }
            
            $act_content .= '<tr><td width="15%">' . date('m-d H:i', $row['date_and_time']) . '</td><td width="15%">' . $ipa . '<td width="30%">' . $row['browsername'] . ' </td><td width="20%">' . $row['urlfrom'] . '</td> <td width="20%">' . $row['page'] . '</td></tr>';
        endforeach;
        $act_content .= '</table><br /><a href="/' . I_N . 'showall/all">Showall</a>';
        
        include 'inctxt/index.php';
        break;
    
    case 'showall':
        $total = 0;
        foreach ($db->select('visitors') as $row) {
            $total += 1;
        }
        $PageSize = 50;
        include 'inctxt/page.php';
        
        
        $order = "ORDER BY date_and_time DESC  limit " . (($showPage - 1) * $PageSize) . " , " . $PageSize;
        $rs    = $db->select('visitors', '*', '', '', '', $order);
        $key   = $str;
        
        
        $act_content = '<table width="100%" border="1" cellspacing="0" cellpadding="0"><th width="15%">Date</th>
    <th width="15%">Ip</th>
    <th width="30%">Browser</th>
    <th width="20%">From</th><th width="20%">Pv</th>';
        foreach ($rs as $row):;
            $ip1 = $row['ip_address'];
            if ($row['link'] == 1) {
                $ipa = '<a href="/' . I_N . 'showdetail/' . $ip1 . '" >' . str_replace('_', '.', $ip1) . '</a>';
            } else {
                $ipa = $ip1;
            }
            
            $act_content .= '<tr><td width="15%">' . date('m-d H:i', $row['date_and_time']) . '</td>
                    <td width="15%">' . $ipa . '
                
                    </td>
                    <td width="30%">' . $row['browsername'] . '</td> <td width="20%">' . $row['urlfrom'] . '</td> <td width="20%">' . $row['page'] . '</td>  
                </tr>';
        endforeach;
        $act_content .= '</table><div id="pagebar"><div class="pagination">' . $key . '</div></div>';
        
        
        include 'inctxt/index.php';
        break;
    
    
    case 'showdetail':
        
        
        
        $rs          = $db->select("pageview", "*", 'ip = ?', array(
            $id
        ), "", "ORDER BY time DESC");
        $act_content = str_replace('_', '.', $id) . '<br /><br />';
        foreach ($rs as $row):;
            $time = date("Y-m-d H:i:s", $row['time']);
            $act_content .= $time . '&nbsp;&nbsp;' . $row['page'] . '<br /> ';
        endforeach;
        include 'inctxt/index.php';
        break;
    
    
    default:
        
        ob_start();
        include 'inctxt/' . $m . '.txt';
        $act_content = ob_get_contents();
        ob_end_clean();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo $act_content;
        }
        
        else {
            include 'inctxt/index.php';
        }
        
}
include 'inctxt/count.php';
if (extension_loaded('zlib')) {
    ob_end_flush();
}
