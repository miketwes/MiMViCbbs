$(function () {
    $(document).on("click", '#ecs a,li.contact a,li.download a,li.ink a,td.thread_title a,#a a,#b a', function (e) {
		
        $('#main-content').html('');
        $('.ajax-loader').show();
        href = $(this).attr("href");
        chref = location.pathname;
        var arr = new Array();
        arr = chref.split("/");    
		loadContent(href, arr);
        history.pushState('', 'New URL: ' + href, href);
        e.preventDefault();
	
    });

    window.onpopstate = function (event) {

        console.log("pathname: " + location.pathname);
        window.location = location.pathname;
    };

});


function loadContent(href, arr) {
	
    $.post(href, {
        'q': href
    }, function (data) {

        $('#main-content').append(data);
        $('.ajax-loader').hide();

        if (href.indexOf("/view") >= 0) {
			$("li.first a").attr("href", "#sub")
            $("#add_post_btn").html('');
            $("#add_post_btn").html('<div>&nbsp;Reply</div>');
        }

        if (jQuery.inArray('view', arr) > -1) {
			if (href == '/'){
            var id1 = arr[2];
            var ht = parseInt($('#' + id1).html()) + 1;
            $('#' + id1).html(ht);
	     	}
	     	$("li.first a").attr("href", "/#sub")
            $("#add_post_btn").html('');
            $("#add_post_btn").html('<div>New post&nbsp;</div>');
        }

    });

}
