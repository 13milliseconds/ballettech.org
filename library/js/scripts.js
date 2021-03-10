/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/

/*jslint browser: true*/
/*global $, jQuery*/

/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
    "use strict";
	var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0], x = w.innerWidth || e.clientWidth || g.clientWidth, y = w.innerHeight || e.clientHeight || g.clientHeight;
	return { width: x, height: y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = function () {
    "use strict";
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout(timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
};

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

window.onbeforeprint = function () {
    "use strict";
    jQuery('.segment').css('margin', '0 0 0 0');
};

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
    "use strict";
  // set the viewport using the function above
    viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
    if (viewport.width >= 768) {
        jQuery('.comment img[data-gravatar]').each(function () {
            jQuery(this).attr('src', jQuery(this).attr('data-gravatar'));
        });
	}
} // end function


// Disable Scrolling

var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
    "use strict";
    e = e || window.event;
    if (e.preventDefault) {
        e.preventDefault();
        e.returnValue = false;
    }
}

function preventDefaultForScrollKeys(e) {
    "use strict";
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

function disableScroll() {
    "use strict";
    if (window.addEventListener) { // older FF
        window.addEventListener('DOMMouseScroll', preventDefault, false);
        window.onwheel = preventDefault; // modern standard
        window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
        window.ontouchmove  = preventDefault; // mobile
        document.onkeydown  = preventDefaultForScrollKeys;
    }
}

function enableScroll() {
    "use strict";
    if (window.removeEventListener) {
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.onmousewheel = document.onmousewheel = null;
        window.onwheel = null;
        window.ontouchmove = null;
        document.onkeydown = null;
    }
}//end scrolling

var waitForFinalEvent = function () {
        "use strict";
        var timers = {};
        return function (callback, ms, uniqueId) {
            if (!uniqueId) {
                uniqueId = "Don't call this twice without a uniqueId";
            }
            if (timers[uniqueId]) {
                clearTimeout(timers[uniqueId]);
            }
            timers[uniqueId] = setTimeout(callback, ms);
        };
    };





/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function ($) {
    "use strict";
    var $width,
        $height,
        $window = $(window),
        $threshold,
        Hvalue,
        vid,
        scroll,
        volume,
        $text,
        $footer,
        $bottom,
        $num = 1, //counting the quotes
        numero,
        carousel,//calls the first carousel every x seconds
        secondcarousel,//calls the second carousel every x seconds
        $quotescroll,//defines the position of the first carousel
        $secondquotescroll,//same for second
        $quoteheight,//defines height of first carousel
        $secondquoteheight,//same for second
        firstStatus,//status of first quote carousel
        secondStatus,//status of second quote carousel
        $scrollTop,//position of top of the screen
        $scrollBottom,//position of bottom of the screen
        $sliderHeight,
        changequote = function ($num) {
            $('#firstquotes .quote.current').removeClass('current');
            $('#firstquotes .nav-dot.current').removeClass('current');
            $('#quote' + $num).addClass('current');
            $('#quote' + $num).css('opacity', 0);
            $('#quote' + $num).animate({opacity: 1}, 1000);
            $('#quote-dot' + $num).addClass('current');
        },
        quotecarousel = function () {
            numero = parseInt($('#firstquotes .quote.current').attr('ID').split('quote')[1], 10) + 1;
            if ($('#quote' + numero).length) {
                changequote(numero);
            } else {
                changequote(1);
            }
        },
        changesecondquote = function ($num) {
            $('#secondquotes .quote.current').removeClass('current');
            $('#secondquotes .nav-dot.current').removeClass('current');
            $('#secondquote' + $num).addClass('current');
            $('#secondquote' + $num).css('opacity', 0);
            $('#secondquote' + $num).animate({opacity: 1}, 1000);
            $('#secondquote-dot' + $num).addClass('current');
        },
        secondquotecarousel = function () {
            numero = parseInt($('#secondquotes .quote.current').attr('ID').split('secondquote')[1], 10) + 1;
            if ($('#secondquote' + numero).length) {
                changesecondquote(numero);
            } else {
                changesecondquote(1);
            }
        },
        $fix = 0,
        $set = $('.segment'),
        len = $set.length,
        $padding,
        $contentheight;
    
    
    function mobileInit() {                                             // Mobile INIT
        $('#mobile-bars').click(function () {
            
            var $prevScroll = 0;
            
            if ($('.nav.showing').length) {
                $('.nav').removeClass('showing');
                $('#content').css('display', 'block');
                $('.header').css('position', 'fixed');
                window.scrollTo(0, $prevScroll);
            } else {
                $('.nav').addClass('showing');
                $('#content').css('display', 'none');
                $('.header').css('position', 'relative');
                $prevScroll = $('body').scrollTop();
                window.scrollTo(0, 0);
            }
            
        });
        
        $('.nav > li').each(function () {
            if ($('.sub-menu', this).length) {
                $('a', this).first().attr('href', '#');
            }
        });
        
        $('.nav > li').click(function () {
            if ($('.sub-menu', this).css('display') === 'none') {
                $('.sub-menu').hide();
                $('.sub-menu', this).show();
            } else {
                $('.sub-menu', this).hide();
            }
        });
    }                   // MOBILE INIT
    
    function pageadjust() {                        // PAGE ADJUST
        
        
        $height = $(window).innerHeight();
        $width = $(window).innerWidth();
        
        if ($('.home').length) {
            $('#home-banner').height($height);
            homevideoResize();
            $('#home-logo').css('height', $height);
            
            //making the photo slider start at the right place
            Hvalue = $('#second-home .content').height();
            $('.home #second-home .slider').css('top', Hvalue);
        }
        
        
        if ($width < 768) {
            
            // Start smooth Scrolling
            $('a').smoothScroll({offset: 0});
            
            mobileInit();
            
        } else {
            
            // Make the background match the content, and resize if too small
            
            if ($('.subpage').length) {
                $threshold = 500;
            } else {
                $threshold = 800;
            }
            
            $set.each(function (index, element) {
                $padding = parseInt($('.content', this).css('padding-top'), 10) + 100;
                $contentheight = $('.content', this).outerHeight() + $padding;
            
                if ($contentheight < $threshold) {
                    $fix = ($threshold - $contentheight) / 2;
                    $('.content', this).css('padding-top', $fix + $padding - 100);
                    if (index < len - 1) {
                        $('.content', this).css('padding-bottom', $fix + 50);
                    } else {
                        $('.content', this).css('padding-bottom', $fix); // Last segment
                    }
                
                    $contentheight = $contentheight - $padding + 2 * $fix;
                }
            
            
                $('.background-image', this).css('height', $contentheight);
                $('.background-color', this).css('height', $contentheight);
                $('.background', this).css('height', $contentheight);
            
                $contentheight = null;
            

            });
        }
        
        
                                                                        // SUBPAGE
        if ($('main.subpage').length) {
        
            if ($('section.chapter').length) {
                $('section.default').hide();
            }
        
            if ($('.rev_slider_wrapper').length) {
                $sliderHeight = $('.rev_slider_wrapper').height();
                $('section#page-banner').css('height', '');
            } else {
                $('section#page-banner').css('height', $height * 0.7);
            }
        
        }
        
        if ($('#page-banner').length) {
            $('#page-banner').css('height', $height * 0.7);
        }
        
    }
    

    function pageinit() {
        
        // Init

        pageadjust();

        
        var $count,
            $angle,
            $countseg,
            $color;
        
        // Adding names on footer login
        $('#user_login').attr('placeholder', 'Username');
        $('#user_pass').attr('placeholder', 'Password');
        
        
        if ($width >= 768) {
            
            // Start smooth Scrolling
            $('a').smoothScroll({offset: -200});
            
        
            
            
            if ($('.home').length) {
                $('.background-color').addClass('bgtransform-home');
                $('#home-banner').css('background-image', '');
            }
        
        // Rotate the segments
        
            $countseg = 0;
            $('.segment').each(function () {

                if ($countseg % 2 === 0) {
                    $(this).addClass('even');
                } else {
                    $(this).addClass('odd');
                }
                $countseg += 1;
            });
        
        //add angles on pages
        
            $('.angled').each(function () {
                $(this).append('<div class="angle-bg"></div>');
                $color = $(this).css('background-color');
                $('.angle-bg', this).css('background-color', $color);
            });
        

            
            
            if ($('.page-top #description').length) {
                $('.page-top').addClass('shaded');
            } else {
                $('section.segment:nth-of-type(3) .background').addClass('shaded');
            }
            
        }
        
        
        
    }
    
    pageinit();
    
    function switchMute() {    //Mute button configuration
        if ($('.fa-volume-off').length) {
            $('i.fa-volume-off').addClass('fa-volume-up');
            $('i.fa-volume-off').removeClass('fa-volume-off');
            $('video').prop('muted', false);
        } else {
            $('i.fa-volume-up').addClass('fa-volume-off');
            $('i.fa-volume-up').removeClass('fa-volume-up');
            $('video').prop('muted', true);
        }
    }
    
    function homevideoResize () { //Resize the home video
        var HDratio = $width / $height;
            console.log('width: ' + $width);
            console.log('height: ' + $height);
            if (HDratio < 1500/851) {
                $('#homevideo').addClass('heightfirst');
            } else {
                $('#homevideo').removeClass('heightfirst');
            }
    }
    
    
    
    $window.resize(function () {
        $width = $(window).innerWidth();
        $width = $(window).innerWidth();
        waitForFinalEvent(function () {
            pageadjust();
        }, 500, "Some unique ID");
        
        if ($('.home').length){
            homevideoResize();
        }
    });
    
    
    
    

        
    
    if ($('.home').length) {                      // HOME
        
        if ($width >= 768) {
            
            //Add sources to the video once everything is loaded
            $(window).bind("load", function() {  
                var homevideo = $('#homevideo'),
                    sourcemp4 = homevideo.data('mp4'),
                    sourcewebm = homevideo.data('webm'),
                    sourceogg = homevideo.data('ogg');
                homevideo.append('<source src="' + sourcemp4 + '" type="video/mp4"></source>' );
                homevideo.append('<source src="' + sourcewebm + '" type="video/webm"></source>' );
                homevideo.append('<source src="' + sourceogg + '" type="video/ogg"></source>' );
                $('#reveal').fadeOut('slow');
                homevideo[0].load();
                homevideo[0].play();
                console.log('Video Playing');
                //Check if it is Safari
                var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
                
                //Check if the video did play
                    if (isSafari) {
                        $('.clickButton').removeClass('hidden');
                        $('#firstSlide').click(function(){
                            if (homevideo[0].paused == false) {
                                homevideo[0].pause();
                                $('.clickButton').removeClass('hidden');
                            } else {
                                homevideo[0].play();
                                $('.clickButton').addClass('hidden');
                            };
                        });
                    } else {
                        $('.clickButton').hide();
                    }
            }); 
        
            $('#fullpage').fullpage({
                bigSectionsDestination: 'top',
                onLeave: function (index, nextIndex, direction) {
                    var leavingSection = $(this);

                    //after leaving section 2
                    if (index === 2 && direction === 'down') {

                        $('#home-logo a').css('opacity', 0).css('right', '-30%');
                        $('#mute-btn').css('opacity', 0);
                        $('#home-banner').fadeOut('slow');

                    } else if (index === 3 && direction === 'up') {

                        setTimeout(function () {
                            $('#home-logo a').css('opacity', 1).css('right', '5%');
                            $('#mute-btn').css('opacity', 1);
                            $('#home-banner').fadeIn('slow');
                        }, 50);

                    }
                }
            });
            
            $('#home-logo a').click(function () {
                $.fn.fullpage.moveSectionDown();
            });
            
            $('#second-home').css('margin-bottom', ($height - $('.content', this).height()) * -1);

            $(window).load(function () {

                $('#fullpage').css('visibility', 'visible');

            });

            $('.half').each(function () {
                Hvalue = $(this).outerHeight() + 200;
                $('.background-color', this).css('height', Hvalue);
            });


            vid = $('video')[0];
            scroll = $(window).scrollTop();

            $('#mute-btn').click(switchMute);
        } else {            // mobile version
            $('#fullpage').css('visibility', 'visible');
        }
         
    }
    
    
    if ($('.single')) {
        
        $('.triangle').click(function () {
            if ($('i.fa-caret-right', this).length) {
                $('i', this).removeClass('fa-caret-right');
                $('i', this).addClass('fa-caret-down');
                $(this).siblings('.texte').show();
            } else {
                $('i', this).removeClass('fa-caret-down');
                $('i', this).addClass('fa-caret-right');
                $(this).siblings('.texte').hide();
            }
        });
    
    }
    
    
    if ($('.back').length) {
        $footer = $('.footer').outerHeight(); // Showinf and positionaing the Back to Top button
        $(window).scroll(function () {
            if ($(window).scrollTop() > 500) {
                $('.back').css('opacity', 1);
            } else {
                $('.back').css('opacity', 0);
            }
            $bottom = $(document).height() - $(window).scrollTop() - $(window).height();
            if ($bottom < $footer) {
                $('.back').css('bottom', $footer - $bottom + 2);
            } else {
                $('.back').css('bottom', 0);
            }
        });
    }
    
                                                                    // EVENTS
    if ($('.events-archive').length || $('.page-id-677').length) {
        $('.segment').first().css('padding-top', 0);
        $text = $('.tribe-events-page-title').text();
        $text = $text.replace('Events for ', '');
        $('.tribe-events-page-title').text($text);
        $(document).ajaxComplete(function () {
            $text = $('.tribe-events-page-title').text();
            $text = $text.replace('Events for ', '');
            $('.tribe-events-page-title').text($text);
        });
    }
    
                                                                      // COMMUNITY
    if ($('.page-id-32').length) {
        $('#teachers-pages').closest('section').addClass('whitelinks');
    }
    
                                                                    // QUOTES
    if ($('.quote').length > 1) {

        $('#firstquotes .quote').each(function () {
            $(this).attr('id', 'quote' + $num);
            $('#firstquotes-nav').append("<a class=\"nav-dot\" data-num=\"" + $num + "\" id=\"quote-dot" + $num + "\"></a>");
            $('#quote-dot' + $num).click(function () {
                changequote($(this).data("num"));
            });
            $num += 1;
        });

        $num = 1;

        $('#secondquotes .quote').each(function () {
            $(this).attr('id', 'secondquote' + $num);
            $('#secondquotes-nav').append("<a class=\"nav-dot\" data-num=\"" + $num + "\" id=\"secondquote-dot" + $num + "\"></a>");
            $('#secondquote-dot' + $num).click(function () {
                changesecondquote($(this).data("num"));
            });
            $num += 1;
        });

        $('#quote1').addClass('current');
        $('#quote-dot1').addClass('current');
        $('#secondquote1').addClass('current');
        $('#secondquote-dot1').addClass('current');
        
        if ($width >= 768) {
            carousel = setInterval(quotecarousel, 15000);
        }
            
        $quotescroll = $('#firstquotes').offset().top;
        $quoteheight = $('#firstquotes').height() + $quotescroll;
            
        firstStatus = 'on';
    
            
            // IF SECOND CAROUSEL
            // ##################################################################
            
        if ($('#secondquotes').length && $width >= 768) {
            

            secondcarousel = setInterval(secondquotecarousel, 15000);

            $secondquotescroll = $('#secondquotes').offset().top;
            $secondquoteheight = $('#secondquotes').height() + $secondquotescroll;

            secondStatus = 'on';
                            
        }
        
            
        
        
        
            
        $(window).scroll(function () {        // Check if quotes are visible. If so, start carousel. If not, stops it
            
            $scrollTop = $(window).scrollTop();
            $scrollBottom = $scrollTop + $height;
            
            if ($quoteheight > $scrollTop && $quotescroll < $scrollBottom) {
                if (firstStatus !== 'on') {
                    carousel = setInterval(quotecarousel, $quotetiming);
                    firstStatus = 'on';
                }
               
            } else {
                clearInterval(carousel);
                firstStatus = 'off';
            }
            
            if ($('#secondquotes').length) {     // same for second quotes
                
                if ($secondquoteheight > $scrollTop && $secondquotescroll < $scrollBottom) {
                    if (secondStatus !== 'on') {
                        secondcarousel = setInterval(secondquotecarousel, $quotetiming);
                        secondStatus = 'on';
                    }
                } else {
                    clearInterval(secondcarousel);
                    secondStatus = 'off';
                }
                
            }
        }); // End of Scroll function
            
    } else if ($('.quote').length === 1) {
        $('.quote').addClass('current');
    }
    



  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
    loadGravatars();


}); /* end of as page load scripts */
