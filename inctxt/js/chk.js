var chk_1 = 0;
var chk_2 = 0;
var chk_3 = 0;
var chk_4 = 0;
var chk_5 = 0;

$(function () {
      $(document).on('change', '.user_name', function() {

        var checkname = $(this).val();
        var availname = remove_whitespaces(checkname);
        var myLength = availname.replace(/[^\x00-\xff]/g, "pp").length + (availname.match(/\n/g) || []).length;

        if (availname != '' && myLength >= 6 && myLength <= 14 && availname.match(/^(\w|[\u4E00-\u9FA5])*$/) != null) {
           
            $('.check').show();
            $('.check').fadeIn(400).html('<img src="/pic/ajax-loading.gif" /> ');

            var String = 'username=' + availname;

            $.ajax({
                type: "POST",
                url: uux,
                data: String,
                cache: false,
                success: function (result) {
                    var result = remove_whitespaces(result);
                    if (result == '') {

                        $('.check').html('<img src="/pic/accept.png" /><font color="green"> This Username Is Avaliable</font>');
                        $(".user_name").removeClass("object_error");
                        $(".user_name").addClass("object_ok");
                        chk_1 = 1;
                        return true;

                    } else {
						
                        $('.check').html('<img src="/pic/error.png" /><font color="red">This Username Is Already Taken</font>');
                        $(".user_name").removeClass("object_ok");
                        $(".user_name").addClass("object_error");
                        return false;
                    }
                }
            });
        } else {

            $('.check').html('<font color="red">username 6-14 (chinese 3-7) and only letters (a-z), <br>numbers (0-9), and chinese are allowed.</font>');
            $(".user_name").removeClass("object_ok");
            $(".user_name").addClass("object_error");
            chk_1 = 11;
            return false;
        }
    });


    $(document).on('change', '.user_psw', function() {

        var availpsw = $(this).val();

        if (availpsw != '' && availpsw.length >= 6 && availpsw.length <= 30) {


            if ($(".user_psw1").val() != '') {

                if (availpsw != $(".user_psw1").val()) {

                    $('.checkpsw').html('<font color="red">Password not match!</font></font>');
                    $(".user_psw").removeClass("object_ok");
                    $(".user_psw").addClass("object_error");
                    return false;
                }


            } else {

                $('.checkpsw').html('<img src="/pic/accept.png" /> ');

                $(".user_psw").removeClass("object_error");
                $(".user_psw").addClass("object_ok");
                chk_2 = 1;
                return true;
            }

        } else {

            $('.checkpsw').html('<font color="red">code error!</font></font>');
            $(".user_psw").removeClass("object_ok");
            $(".user_psw").addClass("object_error");
            return false;
        }

    });

    $(document).on('change', '.user_psw1', function() {

        var checkpsw1 = $(this).val();

        if (checkpsw1 == $(".user_psw").val()) {

            $('.checkpsw1').html('<img src="/pic/accept.png" /> This Usercode Is Avaliable');
            $(".user_psw1").removeClass("object_error");
            $(".user_psw1").addClass("object_ok");
            chk_3 = 1;
            return true;

        } else {

            $('.checkpsw1').html('<font color="red">code error!</font></font>');
            $(".user_psw1").removeClass("object_ok");
            $(".user_psw1").addClass("object_error");
            return false;
        }

    });

    $(document).on('change', '.user_email', function() {

        var checkemail = $(this).val();
        var availemail = remove_whitespaces(checkemail);
        var reg = /^[_a-zA-Z0-9\-\.]+@([\-_a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,3}$/;

        if (availemail != '' && availemail.length >= 8 && availemail.length <= 30 && reg.test(availemail)) {

            $('.checkemail').html('<img src="/pic/accept.png" /> This Usercode Is Avaliable');
            $(".user_email").removeClass("object_error");
            $(".user_email").addClass("object_ok");
            chk_4 = 1;
            return true;

        } else {

            $('.checkemail').html('<font color="red">code error!</font></font>');
            $(".user_email").removeClass("object_ok");
            $(".user_email").addClass("object_error");
            return false;
        }

    });

   $(document).on('keyup', '.user_code', function() {

        var checkcode = $(this).val();
        if ( checkcode.length < 5 ) { return false; }
        
        var availcode = remove_whitespaces(checkcode);

        if (availcode != '' && availcode.length == 5) {
            $('.checkcode').show();
            $('.checkcode').fadeIn(400).html('<img src="/pic/ajax-loading.gif" /> ');

            var String = 'usercode=' + availcode;
            $.ajax({
                type: "POST",
                url: uux,
                data: String,
                cache: false,
                success: function (result) {
                    var result = remove_whitespaces(result);
                    if (result == '') {
                        $('.checkcode').html('<img src="/pic/accept.png" />');
                        $(".user_code").removeClass("object_error");
                        $(".user_code").addClass("object_ok");
                        chk_5 = 1;
                        return true;
                    } else {
                        $('.checkcode').html('<img src="/pic/error.png" /><font color="red">Code dosent match!</font>');

                        $(".user_code").removeClass("object_ok");
                        $(".user_code").addClass("object_error");
                        return false;
                    }
                }
            });

        } else {

            $('.checkcode').html('<font color="red">code error!</font></font>');
            $(".user_code").removeClass("object_ok");
            $(".user_code").addClass("object_error");
            return false;
        }

    });

});

function remove_whitespaces(str) {
    var str = str.replace(/^\s+|\s+$/, '');
    return str;
}

function checkform() {

    var result = chk_1 + chk_2 + chk_3 + chk_4 + chk_5;
    
    if (result == 5) {
        document.forms['myform'].elements['Submit'].disabled = false
    } else {

        document.forms['myform'].elements['Submit'].disabled = ture

    }
}
