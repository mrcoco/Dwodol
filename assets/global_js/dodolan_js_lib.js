// Dodolan Jquery Lib
// Author : Zidni Mubarock
// Url    : http://barockprojects.com
// Email  : zidmubarock@gmail.com
// file name : dodolan_js_lib.js
// Date Picker
// -------------------------------------------------------------------------------------/
$(document).ready(function () {
    $(".hasdate").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: 'c-90:c+0'

    });


});
$(document).ready(function () {

    $(".hastime").datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: 'hh:mm:ss'
    });
});

// COPY TO CLIP BOARD
/*
$(document).ready(function(){
	ZeroClipboard.setMoviePath('http://localhost/dodolan//assets/global_js/zeroclip/ZeroClipboard.swf');
	clip = new ZeroClipboard.Client();
	clip.setHandCursor( true );
	// assign a common mouseover function for all elements using jQuery
	$('.toClipBoard').mouseover( function() {
		// set the clip text to our innerHTML
		text = $(this).attr('alt');
		clip.setText(text);
		// reposition the movie over our element
		// or create it if this is the first time
		if (clip.div) {
			clip.receiveEvent('mouseout', null);
			clip.reposition(this);
		}
		else clip.glue(this);
		// gotta force these events due to the Flash movie
		// moving all around. This insures the CSS effects
		// are properly updated.
		clip.receiveEvent('mouseover', null);
	
	} );


});
*/

$(document).ready(function () {

    var current = $(location).attr('href');
    $('a').each(function () {
        var a_link = $(this).attr("href");
        if (a_link == current) {
            $(this).addClass('current_link');
        }

    });

});

$(document).ready(function () {
    $(".table-Ui tbody tr:visible:even", this).addClass("even");
    $(".table-Ui tbody tr:visible:odd", this).addClass("odd");
});

// delte confirmation 
$(document).ready(function () {
    $('span.del').click(function () {
        var link = $(this).parent().attr('href');
        $('.ajaxdialog').append('Are you Sure to Delete this item permanently ?');
        $('.ajaxdialog').dialog({
            resizable: false,
            title: 'Delete Confirmation',
            height: 140,
            buttons: {
                "Yes": function () {
                    $(location).attr('href', link);
                    $(this).empty().dialog('destroy');
                },
                Cancel: function () {
                    $(this).dialog("close");
                    $(this).empty().dialog('destroy');
                }
            }
        });
        return false;
    });
});


//Tab UI
//---------------------------------------------------------------------------------------/
$(document).ready(function () {

    //Default Action
    $(".tab-Ui .comp .item").hide(); //Hide all content
    $(".tab-Ui .nav .item:first").addClass("actv").show(); //Activate first tab
    $(".tab-Ui .comp .item:first").show(); //Show first tab content
    //On Click Event
    $(".tab-Ui .nav .item").click(function () {
        var tabId = $(this).parent().parent().attr("id");
        $('#' + tabId + ' .nav .item').removeClass("actv"); //Remove any "active" class
        $(this).addClass("actv"); //Add "active" class to selected tab
        $('#' + tabId + ' .comp>.item').hide(); //Hide all tab content
        var activeTab = $(this).attr("rel"); //Find the rel attribute value to identify the active tab + content
        $('#' + tabId + ' .comp > .item[no=' + activeTab + ']').fadeIn(); //Fade in the active content
        return false;
    });

});
$(document).ready(function () {

    $('.msg-Ui .msg-item .close').click(function () {
        var msgItem = $(this).parent();
        $(msgItem).fadeOut(1000);

    });
    $('.msg-Ui .msg-item').delay(4000).slideUp();

})
$(document).ready(function(){
	$('.text-input').each(function () {
        var default_value = this.value;
        $(this).keypress(function () {
            if (this.value == default_value) {
                this.value = '';
            }
        });
        $(this).blur(function () {
            if (this.value == '') {
                this.value = default_value;
            }
        });
    });
	$('.v_ctr').each(function(){
		var curr = $(this);
		var parent = $(this).parent();
		parent.css('display', 'table');
		curr.css('display', 'table-cell');
		curr.css('vertical-align', 'middle');
	});
});

    

(function ($) {
    $.fn.vAlign = function(container) {
        return this.each(function(i){
	   if(container == null) {
	      container = 'div';
	   }
	   var paddingPx = 10; //change this value as you need (It is the extra height for the parent element)
	   $(this).html("<" + container + ">" + $(this).html() + "</" + container + ">");
	   var el = $(this).children(container + ":first");
	   var elh = $(el).height(); //new element height
	   var ph = $(this).height(); //parent height
	   if(elh > ph) { //if new element height is larger apply this to parent
	       $(this).height(elh + paddingPx);
	       ph = elh + paddingPx;
	   }
	   var nh = (ph - elh) / 2; //new margin to apply
	   $(el).css('margin-top', nh);
        });
     };
})(jQuery);

(function($){ $.fn.valign = function(options){

        var defaults = {
    		wraps:false,
    		wrapper: "",
    		halign: false
    	};
    	
    	var T = this;
      
        options = $.extend(defaults, options);

        if(options.wrapper.length>0) {
            //custom wrapper is specified
                T.wrapAll(options.wrapper);
        } else if( (options.wraps==true) || T.parent().is("body")) {
            //no wrapper defined, use default
                T.wrapAll("<div></div>");  
                console.log(options.wraps==true);              
        }
        //shift focus of this to wrapper
            T=this.parent();
            
        TP = T.parent();
            
        if(TP.is("body")) {         
            //if the parent is the BODY then make the body & HTML 100% height
                TP.css("height","100%");
                $("html").attr("style","height:100%");
        }
        
        if(TP.css("position")!="absolute") TP.css("position","relative");
        T.css({
            "position":"absolute",
            "height":T.height(),
            "top":"50%",
            "left":"0px",
            "margin-top": 0-(T.height()/2)
        })
        if(options.halign) {
            T.css({
                "width":T.width(),
                "left":"50%",
                "margin-left": 0-(T.width()/2)
            })   
        }



  
}})(jQuery); 



//The jQuery Setup
$(document).ready(function () {

    $('#clonetrigger').click(function () {
        var yourclass = ".clonable"; //The class you have used in your form
        var clonecount = $(yourclass).length; //how many clones do we already have?
        var newid = Number(clonecount) + 1; //Id of the new clone   
        $(yourclass + ":first").fieldclone({ //Clone the original elelement
            newid_: newid,
            //Id of the new clone, (you can pass your own if you want)
            target_: $("#formbuttons"),
            //where do we insert the clone? (target element)
            insert_: "before",
            //where do we insert the clone? (after/before/append/prepend...)
            limit_: 4 //Maximum Number of Clones
        });
        return false;
    });

});

(function ($) {
    $.fn.notice = function (title, content) {
        $(this).append('<div class="header_notice">' + content + '</div>');
        $(this).dialog({
            title: title,
            show: 'easeInExpo',
            hide: 'easeOutExpo',
            minHeight: 100,
            create: function (event, ui) {

            },
            open: function (event, ui) {
                $('.ui-dialog').addClass('msg-Ui');
                $('.ui-dialog-titlebar').addClass('msg-header');
                $('.ui-dialog-titlebar').addClass(title);


            },
            close: function (event, ui) {
                $('.ui-dialog').removeClass('msg-Ui');
                $('.ui-dialog-titlebar').removeClass('');
                $(this).empty().dialog('destroy');
            }
        });




    }

})(jQuery);

//The Plugin Script Cloning Form
(function ($) {

    $.fn.fieldclone = function (options) {

        //==> Options <==//
        var settings = {
            newid_: 0,
            target_: $(this),
            insert_: "before",
            limit_: 0
        };
        if (options) $.extend(settings, options);

        if ((settings.newid_ <= (settings.limit_ + 1)) || (settings.limit_ == 0)) { //Check the limit to see if we can clone
            //==> Clone <==//
            var fieldclone = $(this).clone();
            var node = $(this)[0].nodeName;
            var classes = $(this).attr("class");

            //==> Increment every input id <==//
            var srcid = 1;
            $(fieldclone).find(':input').each(function () {
                var s = $(this).attr("name");
                $(this).attr("name", s.replace(eval('/_' + srcid + '/ig'), '_' + settings.newid_));
            });

            //==> Locate Target Id <==//
            var targetid = $(settings.target_).attr("id");
            if (targetid.length <= 0) {
                targetid = "clonetarget";
                $(settings.target_).attr("id", targetid);
            }

            //==> Insert Clone <==//
            var newhtml = $(fieldclone).html().replace(/\n/gi, "");
            newhtml = '<' + node + ' class="' + classes + '">' + newhtml + '</' + node + '>';

            eval("var insertCall = $('#" + targetid + "')." + settings.insert_ + "(newhtml)");
        }
    };

})(jQuery);
(function ($) {

    $.fn.jRedi = function (location) {
        $(location).attr('href', location)
    }
})(jQuery);



jQuery.event.special.keyupdelay = {
    add: function (handler, data, namespaces) {
        var delay = data && data.delay || 100,
            that = this;

        return function (event) {
            setTimeout(function () {
                handler.apply(that, arguments);
            }, data);
        }
    },

    setup: function (data, namespaces) {
        jQuery(this).bind("keyup", jQuery.event.special.keyupdelay.handler);
    },

    teardown: function (namespaces) {
        jQuery(this).unbind("keyup", jQuery.event.special.keyupdelay.handler);
    },

    handler: function (event) {
        event.type = "keyupdelay";
        jQuery.event.handle.apply(this, arguments);
    }
};

/*! Copyright 2011, Ben Lin (http://dreamerslab.com/)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 1.0.0
 *
 * Requires: jQuery 1.2.6+
 */

$.fn.center = function (options) {

    // cache gobal
    var $w = $(window),

        scrollTop = $w.scrollTop();

    return this.each(function () {

        // cache $( this )
        var $this = $(this),

            // merge user options with default settings
            settings = $.extend({
                against: 'window',
                top: false,
                topPercentage: 0.5
            }, options),

            centerize = function () {
                var $against, x, y;

                if (settings.against === 'window') {
                    $against = $w;
                } else if (settings.against === 'parent') {
                    $against = $this.parent();
                    scrollTop = 0;
                } else {
                    $against = $this.parents(against);
                    scrollTop = 0;
                }

                x = (($against.width()) - ($this.outerWidth())) * 0.5;
                y = (($against.height()) - ($this.outerHeight())) * settings.topPercentage + scrollTop;

                if (settings.top) y = settings.top + scrollTop;

                $this.css({
                    'left': x,
                    'top': y
                });
            };

        // apply centerization
        centerize();
        $w.resize(centerize);
    });
};
/// STORE PRODUCT SNAP ANIMATION
$(document).ready(function () {
    $('.productSnap .productImg').hover(function () {
        var tool = $(this).find('.snap_tool');
		var img = $(this).find('img.prod');
		img.animate({opacity : '0.5'},500);
        tool.show('slide', {
            direction: "down"
        }, 500);

    }, function () {

        var tool = $(this).find('.snap_tool');
		var img = $(this).find('img.prod');
		img.animate({opacity : '1'},500);
        tool.hide('slide', {
            direction: "down"
        }, 500);




    });

});

// JQUERY TABED LINE MENU
/*********************
//* jQuery Drop Line Menu- By Dynamic Drive: http://www.dynamicdrive.com/
//* Last updated: May 9th, 11'
//* Menu avaiable at DD CSS Library: http://www.dynamicdrive.com/style/
*********************/

var droplinemenu = {

    arrowimage: {
        classname: 'downarrowclass',
        src: 'down.gif',
        leftpadding: 5
    },
    //customize down arrow image
    animateduration: {
        over: 200,
        out: 100
    },
    //duration of slide in/ out animation, in milliseconds
    buildmenu: function (menuid) {
        jQuery(document).ready(function ($) {
            var $mainmenu = $("#" + menuid + ">ul")
            var $headers = $mainmenu.find("ul").parent()
            $headers.each(function (i) {
                var $curobj = $(this);
                var $subul = $(this).find('ul:eq(0)');
			
			var $ulobject = $curobj.children("ul:eq(0)");
				var $ulw = 	0;
				$ulobject.children("li").each(function () {
					$ulw = $ulw+$(this).width();
				});
				$ulobject.css({ width : $ulw});
			
                this._dimensions = {
                    h: $curobj.find('a:eq(0)').outerHeight()
                }
                this.istopheader = $curobj.parents("ul").length == 1 ? true : false
                if (!this.istopheader) $subul.css({
                    left: 0,
                    top: this._dimensions.h
                })
                var $innerheader = $curobj.children('a').eq(0)
                $innerheader = ($innerheader.children().eq(0).is('span')) ? $innerheader.children().eq(0) : $innerheader //if header contains inner SPAN, use that
                $innerheader.append('<img src="' + droplinemenu.arrowimage.src + '" class="' + droplinemenu.arrowimage.classname + '" style="border:0; padding-left: ' + droplinemenu.arrowimage.leftpadding + 'px" />')
                $curobj.hover(

                function (e) {
                    var $targetul = $(this).children("ul:eq(0)");
                    if (this.istopheader) $targetul.css({
                        left: $mainmenu.position().left,
                        top: $mainmenu.position().top + this._dimensions.h
                    })
                    if (document.all && !window.XMLHttpRequest) //detect IE6 or less, fix issue with overflow
                    $mainmenu.find('ul').css({
                        overflow: (this.istopheader) ? 'hidden' : 'visible'
                    })
                    $targetul.fadeIn(droplinemenu.animateduration.over)
                }, function (e) {
                    var $targetul = $(this).children("ul:eq(0)")
                    $targetul.fadeOut(droplinemenu.animateduration.out)
                }) //end hover
            }) //end $headers.each()
            $mainmenu.find("ul").css({
                display: 'none',
                visibility: 'visible',
                width: $mainmenu.width(),
            })
        }) //end document.ready
    }
}

function addMsg(content, header){
	$.jGrowl(content, { position : 'center', header: header, theme: header });
}

$(document).ready(function () {
    $('.hv_child > span >  a').click(function () {
        return false;
    })
});

function delayTimer(delay) {
    var timer;
    return function (fn) {
        timer = clearTimeout(timer);
        if (fn) timer = setTimeout(function () {
            fn();
        }, delay);
        return timer;
    }
}

function print_autolist(object, class_to, ident, target) {
    wrap = $(target).parent();
    width = $(target).before().outerWidth();

    var list = '<div class="ajx_autolist ' + class_to + '" style="width:' + (width - 2) + 'px"><ul>';
    $.each(object, function (key, val) {
        list += '<li ' + ident + '="' + val.id + '" class="cat_name">' + val.name + '</li>';
    });
    list += '</ul></div>';
    wrap.append(list);

}
$(function() {
    $('.noAutoComp').attr('autocomplete', 'off');
});

jQuery.fn.dodolTab = function(setting) {
	var def_set = {
		active : 0,
		effect : 'drop',  
	}
//	$.extend(default, conf);
	var conf = $.extend({}, def_set, setting);
    var obj = $(this[0]) // It's your element;
	var tabpane = obj.find(".tab_pane ul li");
	var contentpane = obj.find(".tab_content .content");
	var t = ''
	contentpane.each(function(index){
		$(this).attr('id', obj.attr('id')+"_content_"+index);
		});
	tabpane.each(function(index){
		
		var curobj = $(this);
		var itscontId = '#'+obj.attr('id')+"_content_"+index;
		var rel =$(this).text().replace(/ /g,'_').toLowerCase();
		var itsCont = $(itscontId);
		if(index == conf.active){
			curobj.addClass('active');
			itsCont.addClass('active');
		}
		
		curobj.find('a').attr("rel", rel);
		curobj.find('a').attr('href',itscontId );
		obj.find(itscontId).attr('name', rel);
		
		curobj.click(function(){
			contentpane.removeClass('active');
			tabpane.removeClass('active');
			$(this).addClass('active');
			itsCont.addClass('active');
			return false;
		});
	
		
	});
	
};
$(document).ready(function(){
	var form = $('.form-Ui');
	var inputset = form.find('.inputSet:visible');
	inputset.each(function(index){
		var field_wrap = $(this).find('.input');
		var field_input = $(this).find(':input');
		
		if(field_input.attr('type') != ('radio' || 'checkbox')){
			var w = field_wrap.width() - (field_input.css('padding-left').replace('px', '')*2);
			field_input.css({
				width : w,
			});
		}
		


	});
});

function dw_ajxUpload (file, user_opt) {
	
	var reader;
	var params = {};
	var formdata = false;
	
	var default_opt = {
		data_post : {},
		action_url : '',
		files_key : 'images',
		list_element : '.to_list',
		oncomplete : function (res) {
		alert(res.status);
		},
		start: function(){
				
		},
	}
	// oVeriding the default parameter
	var options = $.extend({}, default_opt, user_opt);
	var list = $(options.list_element), img;
	var body = $('body');
	// initialize the formdata
	formdata = new FormData();
	
	// append the each additional data to formdata
	$.each(options.data_post, function(key, value) { 
	  formdata.append(key, value);
	});
					
	// TEsted
	if (typeof file !== "undefined") {
		// file is multiple so, send it as array
		if(file.length > 1){
			for (var i=0, l=file.length; i<l; i++) {
				var cur_file = file[i];
				if (typeof FileReader !== "undefined" && (/image/i).test(cur_file.type)) {
					
					reader = new FileReader();
					reader.readAsDataURL(cur_file);
				    formdata.append(options.files_key+'['+i+']', cur_file);
				}
			}	
		}
		// file not array, 
		else{
			var cur_file = file[0];
			if (typeof FileReader !== "undefined" && (/image/i).test(cur_file.type)) {
			
				reader = new FileReader();
				reader.readAsDataURL(cur_file);
			    formdata.append(options.files_key, cur_file);
			}
		}
		
	}
	else {
		return false;
	}
	
	
	dw_show_ajaxLoad();		
	// execution the ajax,
	$.ajax({
		url: options.action_url,
		type: "POST",
		data: formdata,
		dataType : 'json',
		processData: false,
		contentType: false,
	
		success: function (res) {
			dw_hide_ajaxload();
			options.oncomplete.call(this, res);
		},
		
		
		
	});


}
(function( $ ){
$.fn.serializeJSON=function() {
var json = {};
jQuery.map($(this).serializeArray(), function(n, i){
json[n['name']] = n['value'];
});
return json;
};
})( jQuery );

function dw_show_ajaxLoad(){
var tpl = '<div class="ajax_load_global" id="ajaxload">Please Wait</div>';
$(tpl).appendTo('body');
}
function dw_hide_ajaxload(){
	var suspect = $('#ajaxload');
	suspect.hide('fade', null, 500, function(){ suspect.remove()});
}


(function(){
 
    var special = jQuery.event.special,
        uid1 = 'D' + (+new Date()),
        uid2 = 'D' + (+new Date() + 1);
 
    special.scrollstart = {
        setup: function() {
 
            var timer,
                handler =  function(evt) {
 
                    var _self = this,
                        _args = arguments;
 
                    if (timer) {
                        clearTimeout(timer);
                    } else {
                        evt.type = 'scrollstart';
                        jQuery.event.handle.apply(_self, _args);
                    }
 
                    timer = setTimeout( function(){
                        timer = null;
                    }, special.scrollstop.latency);
 
                };
 
            jQuery(this).bind('scroll', handler).data(uid1, handler);
 
        },
        teardown: function(){
            jQuery(this).unbind( 'scroll', jQuery(this).data(uid1) );
        }
    };
 
    special.scrollstop = {
        latency: 100,
        setup: function() {
 
            var timer,
                    handler = function(evt) {
 
                    var _self = this,
                        _args = arguments;
 
                    if (timer) {
                        clearTimeout(timer);
                    }
 
                    timer = setTimeout( function(){
 
                        timer = null;
                        evt.type = 'scrollstop';
                        jQuery.event.handle.apply(_self, _args);
 
                    }, special.scrollstop.latency);
 
                };
 
            jQuery(this).bind('scroll', handler).data(uid2, handler);
 
        },
        teardown: function() {
            jQuery(this).unbind( 'scroll', jQuery(this).data(uid2) );
        }
    };
 
})();