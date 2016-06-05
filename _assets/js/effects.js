jQuery(document).ready(function($) {
		
	// Main nav
	if($(window).width() > 767) {
	
		// Desktop
		$('.menu-nav ul').superfish({
	        delay: 200,
	        animation: {
	            opacity: 'show'
	        },
	        autoArrows: false,
	        dropShadows: false,
	        speed: 'fast'
	    });
	    $('.menu-nav ul ul a').hover(function() {
	        $(this).stop().animate({ paddingLeft: '20px' }, 'fast');
	    }, function() {
	        $(this).stop().animate({ paddingLeft: '10px' }, 'fast');
	    });

    } else {
    	
    	// Mobile
		$('#main-navIcon').click(function(e) {
			var height = $('#main-nav .menu').height();
	        if ($(this).hasClass('active') == true) {
	            $(this).removeClass('active');
	            $('#main-nav .menu').slideUp('fast');
	            $('header').animate({'padding-top': 0}, 'fast');
	            
	        } else {
	            $(this).addClass('active');
	            $('#main-nav .menu').slideDown('fast');
	            $('header').animate({'padding-top': height}, 'fast')
	        }
	        e.preventDefault();
	    });
	    
    }
    
    // Top Bar
    $('#top-open').click(function(e) {
        if ($(this).hasClass('active') == true) {
            $(this).removeClass('active');
            $('#top-closed').removeClass('active');
            $(this).prev('#top').slideUp('fast');
        } else {
            $(this).addClass('active');
            $('#top-closed').addClass('active');
            $(this).prev('#top').slideDown('fast')
        }
        e.preventDefault();
    });
    $('#top-closed').click(function(e) {
        if ($(this).hasClass('active') == true) {
            $(this).removeClass('active');
            $('#top-open').removeClass('active');
            $(this).prev().prev('#top').slideUp('fast');
        } else {
            $(this).addClass('active');
            $('#top-open').addClass('active');
            $(this).prev().prev('#top').slideDown('fast')
        }
        e.preventDefault();
    });
    
    // Back to top
	$('#back-to-top').click(function(e) {
		$('body, html').animate({ scrollTop: 0 }, 'fast');
		e.preventDefault();
	});
	
	// Slider
	$('.slider-wrap').animate({ opacity: 1 }, 'fast');
    
   	// Comment form
    $('#comment-form-submit').click(function() { $('#comment-form').submit(); });
    $('#comment-form').validate();
    
    // Contact form
    $('#contact-form-submit').click(function() { $('#contact-form').submit(); });
    $('#contact-form').validate();
    
    // Videos
    $('.entry-video').fitVids();
    
    // Shortcode - Tabs
    var b = $('.tabs .tab');
    b.hide().filter(':first').show();
    $('.tabs .nav a').click(function() {
        b.hide();
        b.filter(this.hash).show();
        $('.tabs .nav li').removeClass('active');
        $(this).parent().addClass('active');
        return false
    }).filter(':first').click();

	// Shortcode - Toggle
	$('.toggle.open').addClass('active');
	$('.toggle').click(function() {
		if ($(this).hasClass('active') == true) {
			$(this).removeClass('active');
			$(this).find('.toggle-content').hide();
		} else {
			$(this).addClass('active');
			$(this).find('.toggle-content').show();
		}
	});
	$('.toggle').mouseover(function() {
		$(this).addClass('hover')
	}).mouseout(function() {
		$(this).removeClass('hover') });
	
	// Shortcode - Tooltip
	$('.tooltip').hover(function() {
        $(this).find('.tooltip-box').stop().animate({ opacity: 'show' }, 'fast');
    }, function() {
        $(this).find('.tooltip-box').stop().animate({ opacity: 'hide' }, 'fast');
    });
	
    
});
