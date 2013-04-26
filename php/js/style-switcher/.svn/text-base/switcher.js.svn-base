  jQuery(document).ready(function($) {
    $('#colorpicker').ColorPicker({
			onShow: function (colpkr) {
				$(colpkr).fadeIn("fast");
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut("fast");
				return false;
			},
			onChange: function (hsb, hex, rgb) {
        var color = hex;
        var defaultPattern = "url(../images/body-bg-1.png)";
        $('body').css({
            backgroundColor: '#' + color,
            backgroundImage : defaultPattern
        });     
        $.cookie("portable_cookie_color", color);   
        $.cookie("portable_cookie_pattern", null);   
        $.cookie("portable_cookie_defaultBg", defaultPattern);   
			},
    
    });    
    
    $('#style-switcher a.color-box').each(function (i) {
        var a = $(this);
        a.css({
            backgroundColor: '#' + a.attr('data-rel')
        })
    })    
    

   var switcher_skins = $('#style-switcher a.color-box');
   var switcher_link = $('#skins-switcher');
   switcher_skins.each(function(i) {
    var color = $(this).attr('data-rel');
    var defaultPattern = "url(images/body-bg-1.png)";
 
     
      
   });  
   
     /*STYLESHEETS LOAD STARTS*/ 
   switcher_skins.click(function(e) {
    var color = $(this).attr('data-rel');
    var title = $(this).attr('title');
    var skins;
    var defaultPattern = "url(images/body-bg-3.png)";
    var defaultPatternLight = "url(images/body-bg-1.png)";
    
    if (title == "dark-yellow") {
      switcher_link.attr('href',"css/style.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	
	  if (title == "dark-green") {
      switcher_link.attr('href',"css/dark-theme-light-green.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	 if (title == "dark-blue") {
      switcher_link.attr('href',"css/dark-theme-light-blue.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	
		 if (title == "dark-red") {
      switcher_link.attr('href',"css/dark-theme-dark-red.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
		 if (title == "dark-light-purple") {
      switcher_link.attr('href',"css/dark-theme-light-purple.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-light-orange") {
      switcher_link.attr('href',"css/dark-theme-light-orange.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-light-yellow") {
      switcher_link.attr('href',"css/dark-theme-light-yellow.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-grey") {
      switcher_link.attr('href',"css/dark-theme-dark-grey.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-purple") {
      switcher_link.attr('href',"css/dark-theme-dark-purple.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-yellow") {
      switcher_link.attr('href',"css/dark-theme-dark-yellow.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-red") {
      switcher_link.attr('href',"css/dark-theme-dark-dark-red.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-light-pink") {
      switcher_link.attr('href',"css/dark-theme-light-pink.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-orange") {
      switcher_link.attr('href',"css/dark-theme-dark-orange.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-blue") {
      switcher_link.attr('href',"css/dark-theme-dark-blue.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-simply-red") {
      switcher_link.attr('href',"css/dark-theme-simply-red.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-green") {
      switcher_link.attr('href',"css/dark-theme-dark-green.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-pink") {
      switcher_link.attr('href',"css/dark-theme-dark-pink.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-dark-brown") {
      switcher_link.attr('href',"css/dark-theme-dark-brown.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "dark-deep-blue") {
      switcher_link.attr('href',"css/dark-theme-deep-blue.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
		if (title == "dark-coffe") {
      switcher_link.attr('href',"css/dark-theme-coffe.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });   
    }
	if (title == "light-dark-blue") {
      switcher_link.attr('href',"css/light-theme-dark-blue.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-orange") {
      switcher_link.attr('href',"css/light-theme-orange.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-light-blue") {
      switcher_link.attr('href',"css/light-theme-light-blue.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-red") {
      switcher_link.attr('href',"css/light-theme-red.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	
	if (title == "light-purple") {
      switcher_link.attr('href',"css/light-theme-purple.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-dark-orange") {
      switcher_link.attr('href',"css/light-theme-dark-orange.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-light-yellow") {
      switcher_link.attr('href',"css/light-theme-light-yellow.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-light-green") {
      switcher_link.attr('href',"css/light-theme-light-green.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-dark-purple") {
      switcher_link.attr('href',"css/light-theme-dark-purple.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-dark-yellow") {
      switcher_link.attr('href',"css/light-theme-dark-yellow.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-dark-red") {
      switcher_link.attr('href',"css/light-theme-dark-red.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-pink") {
      switcher_link.attr('href',"css/light-theme-pink.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }	
	if (title == "light-deep-orange") {
      switcher_link.attr('href',"css/light-theme-deep-orange.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }		
	if (title == "light-grey") {
      switcher_link.attr('href',"css/light-theme-grey.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }		
	if (title == "light-deep-red") {
      switcher_link.attr('href',"css/light-theme-deep-red.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }
	if (title == "light-dark-green") {
      switcher_link.attr('href',"css/light-theme-dark-green.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }	
	if (title == "light-dark-pink") {
      switcher_link.attr('href',"css/light-theme-dark-pink.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }	
	if (title == "light-brown") {
      switcher_link.attr('href',"css/light-theme-brown.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }	
	if (title == "light-light-red") {
      switcher_link.attr('href',"css/light-theme-light-red.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }	
 	if (title == "light-deep-blue") {
      switcher_link.attr('href',"css/light-theme-deep-blue.css");
      var atrrHref = switcher_link.attr('href');
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPatternLight
      });   
    }   	
	
	
	
	
	
     
    $.cookie("portable_cookie_pattern", null);   
    $.cookie("portable_cookie_bgimage",null);

    $.cookie("portable_cookie_color", color);  
    $.cookie("portable_cookie_skins", atrrHref);
    $.cookie("portable_cookie_defaultBg", defaultPattern);    
    return false;
	
   });  
   
  var color = $.cookie("portable_cookie_color");
  var portable_skins = $.cookie("portable_cookie_skins");
  var defaultPattern = $.cookie("portable_cookie_defaultBg");
  var pattern = $.cookie("portable_cookie_pattern");
  
  if (portable_skins) {
    $("#skins-switcher").attr("href",portable_skins);
    $('body').css({
        backgroundColor: '#' + color,
        backgroundImage : pattern
    });
  }

  $('#style-switcher a.pattern-box').click(function (e) {
      e.preventDefault();
      var patternUrl = 'url(images/pattern/' + $(this).attr('data-rel') + '.png)';
      $('body').css({
          backgroundImage: patternUrl,
          backgroundRepeat: "repeat"
      });
      $.cookie("portable_cookie_bgimage",null);
      $.cookie("portable_cookie_pattern", patternUrl)
  });
  
  var defaultPattern = $.cookie("portable_cookie_defaultBg");
  var color = $.cookie("portable_cookie_color");
  var background = $.cookie("portable_cookie_bgimage");
  if (color) {
      $('body').css({
          backgroundColor: '#' + color,
          backgroundImage : defaultPattern
      });
  }
  var pattern = $.cookie("portable_cookie_pattern");
  if (pattern) {
      $('body').css({
          backgroundImage: pattern,
          backgroundRepeat: "repeat"
      });
  } else {
    if (background) {
        $('body').css({
          backgroundImage: background,
          backgroundRepeat: "repeat",
          backgroundPosition: "top center",
        
        });
    }    
  }  

  $('#style-switcher a.bg-box').each(function (i) {
    var backgroundUrl = 'url(images/' + $(this).attr('data-rel') + '.png)';
    var a = $(this);
      a.css({
          backgroundImage: backgroundUrl
      })
  })
    
  $('#style-switcher a.bg-box').click(function (e) {
      e.preventDefault();
      var backgroundUrl = 'url(images/' + $(this).attr('data-rel') + '.png)';
      $('body').css({
          backgroundImage: backgroundUrl,
          backgroundRepeat: "repeat",
        
        
      });
    $.cookie("portable_cookie_bgimage",backgroundUrl)
  });

  var background = $.cookie("portable_cookie_bgimage");
  if (background) {
      $('body').css({
        backgroundImage: background,
        backgroundRepeat: "repeat",
      
      
      });
  }
         
});   
 