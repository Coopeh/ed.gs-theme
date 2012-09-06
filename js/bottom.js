jQuery('.icon').on('click', function(e){
	if($(".popup").is(':visible')){
		$('.popup').fadeOut('slow');
	} else {
		$('.popup').fadeIn(250);
		if($(e.target).data('oneclicked')!='yes')
        {
			start();
		}
		$(e.target).data('oneclicked','yes');
	}
});

function start() {

jQuery.getJSON('http://lkd.to/api/ed/?callback=?', function(data) {
    if(data.error) {
        alert(data.error);
    } else {
        jQuery('.loading').remove();
        jQuery.each(data.links, function(link,i) {
            var text = i.url.replace(/.*?:\/\//g, "");
            var user = 'ed';

            if (i.slug == 'email') {
                text = "ed@ed.gs";
                name = 'mail';
            }
            else if (i.slug == 'skype') {
                text = "ed.cooper";
                name = i.slug;
                i.url = "skype:ed.cooper?chat";
            }
            else if (i.slug == 'aim') {
                name = i.slug;
                i.url = "";
        	}
        	else if (i.slug == 'msn') {
        		name = i.slug;
        		i.url = "";
        	}
        	else if (i.slug == 'site') {
        		text = '<span>'+text+'</span>';
        		name = i.slug;
        	}
        	else if (i.slug == 'last.fm') {
        		name = 'lastfm';
        	}
        	else if (i.slug == 'google+') {
        		name = 'googleplus';
        	}
        	else {
        		name = i.slug;
        	}
        	var className = 'ss-'+name;
        	var link = $('<a>', {
        	    href: i.url,
        	    html: text
            });
            $('<li>' , {
                class: className,
            }).append(link).appendTo('.popup ul');
        });
    }

});

}
$(document).mouseup(function (e)
{
    var container = $('.popup');
    if (container.has(e.target).length === 0)
    {
        container.fadeOut('slow');
    }
});
$('a:not([href^=mailto])').click(function() {
    var location = $(this).attr('href');
    $('#content').animate({
        opacity: 0
    }, 450);
    $('.bounce').animate({
        left: -500
    }, 500, function() {
        document.location = location;
    });
    return false;
});