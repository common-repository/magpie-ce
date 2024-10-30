jQuery(document).ready(function($) {


jQuery(".ggtooltip").hover(function()
{
	jQuery(this).children(".ggtooltipgfx").stop(true).show().animate({"top":"40","opacity":0},1000);
	jQuery(this).children(".ggtooltipshow").stop(true).show().animate({"top":"30","opacity":1},450);
	
	},function()
	
	{
		jQuery(this).children(".ggtooltipgfx").stop(true).show().animate({"top":"0","opacity":1},1000);
		jQuery(this).children(".ggtooltipshow").stop(true).animate({"top":"50","opacity":0},300,function(){jQuery(this).hide();});
	
		});
		

jQuery(".howto_box").find("img").width(45).css({"float":"right"}).addClass("shadow");
jQuery(".howto_box").hover(function()
			{
				jQuery(this).find("img").stop(true).animate({"width":100},1000,'easeOutElastic');
		
		},function() {
			
			jQuery(this).find("img").stop(true).animate({"width":50},1800,'easeOutElastic');
			}
		
		
		);


/*
$("div.contentToChange p.firstparagraph:hidden").slideDown("slow");
$("div.contentToChange p.firstparagraph:visible").slideUp("slow");

*/
	jQuery(".inverse_checkbox").live('click',function()				
			{
				//var checked_status = this.checked;
				name=jQuery(this).attr("id");
				// input[type=checkbox]');
				//alert(name);
				jQuery("input[class="+name+"]").each(function()
				{
					//alert(34);
				//	if (this.checked) 
					this.checked = this.checked ^ 1;//this.checked;
					//else this.checked = 1;
				});
			});	
			
			
	jQuery(".showthickbox").live('click',function(){
		img=jQuery(this).attr("href");
		title=jQuery(this).attr("title");
		jQuery(this).fancybox({'type':'image','href':img,'titlePosition':'top','transitionIn':'elastic','transitionOut':'elastic','showCloseButton':true});
		return false;
	});
	
	
	
	//jQuery("#fancybox1").fancybox();
	
	
	jQuery(".show_csv_content a").live('click',function(){
			
			jQuery("#your_csv_here textarea").slideToggle();
			file=jQuery(this).attr('href');
			jQuery("#your_csv_here textarea").load(file);
			jQuery("#your_csv_here textarea").slideToggle();
			return false;
	});
	
/*
jQuery(".menuitem span").eq(0).addClass("active");


jQuery(".menuitem span").live('click',function(){
	jQuery(this).parent(".menuitem").children("span").each(function(){
		jQuery(this).toggleClass("active");
	});
	//return jQuery(this).attr("class");
});
*/
		
			
			//alert(wecpipro_menu_import_id);
			
			//set_active_import_page(wecpipro_menu_import_id);
			
			
			



/*obsolete */
jQuery('.ajax_update_selection').click(function() {
name=jQuery(this).attr("name");
value=jQuery(this).val();
ajax_magpie_save_option(name,value);
//checked=jQuery(this).attr("checked");
//alert(jQuery(this).attr("name") +" - " + jQuery(this).val()+" - " + jQuery(this).attr("checked"));
//return;

});	



	  	
jQuery('.ajax_update_selection_checked').click(function() {
name=jQuery(this).attr("name");
checked=jQuery(this).attr("checked");
if (checked==true) checked="on"; else checked="off";
ajax_magpie_save_option(name,checked);
//if (checked==true) checked="on"; else checked="off";
//alert(jQuery(this).attr("name") +" - " + jQuery(this).val()+" - " + jQuery(this).attr("checked"));
//return;

});				
			
			
			

jQuery('#upload_image_button').click(function() {
 formfield = jQuery('#upload_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});




window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#upload_image').val(imgurl);
 tb_remove();
}




/*
var midmenup = jQuery("ul#wecpi_sdt_menu li").size();
var midmp=0;
var dura=250;
function magpiepro_menu_anim() {

	jQuery(".magpiepro_menu li")
	.eq(midmp)
	.animate(
    
	{ top: 0,opacity:1 }, // what we are animating
    {
        duration: dura, // how fast we are animating
		easing: "easeOutBack", // the type of easing
        complete: function() {
			dura*=.8;
			if (midmp++<midmenup) magpiepro_menu_anim();
		}
	});
	
	//if (midmp++<5) 
	//setTimeout('magpiepro_menu_anim',1400);
}
jQuery(".magpiepro_menu li").css({'top':0});
magpiepro_menu_anim();
*/




jQuery('.fancythis').fancybox();
	
	
jQuery(".magpieopenclose").click(function(){
$t=jQuery(this).next('.thisopenclose');
$t.slideToggle('slow', function() {});
jQuery(this).toggleClass('open');
});


/*
jQuery(".magpie_page").resize(function(){
	alert(1);
		chh=jQuery(".magpie_page.active").outerHeight()+jQuery("#wecpiheader").outerHeight()+160;
		jQuery("#magpiewrapper").css({'height':chh});
});
*/
jQuery(".mainmenu").click(function() {


jQuery(".mainmenu.active").removeClass("active");
/*.find('img').animate({
							'width':'0px',
							'height':'0px',
							'left':'16px','top':'16px','opacity':'0'},400);
	*/						
	jQuery(this).addClass("active");
	
	eraseCookie('wecpipro_menu');
	createCookie('wecpipro_menu',jQuery(this).index(),1000);
	
	
	jQuery(".magpie_page.active").removeClass("active");
	jQuery(".magpie_page").eq(jQuery(this).index()).addClass("active");

//	if ($new_magpie_page.hasClass("active")) return;
	
//	$old_magpie_page = 
	
	
/*	
	$old_magpie_page
	.stop(true)
	.removeClass("active")
	.animate(
	{ opacity:0,top:100 }, // what we are animating
    {
        duration: 600, // how fast we are animating
        complete: function() {$old_magpie_page.hide();}
	});
	//alert(jQuery(this).index());
	
	$new_magpie_page = jQuery(".magpie_page").eq(jQuery(this).index());
	
	chh=$new_magpie_page.outerHeight()+jQuery("#wecpiheader").outerHeight()+60;
	jQuery("#magpiewrapper").css({'height':chh});
	
	$new_magpie_page
	.stop(true)
	.show()
	.addClass("active")
	.animate(
    
	{ opacity:1,top:0 }, // what we are animating
    {
        duration: 600, // how fast we are animating
		complete: function() {}
	});
*/	
	
	
});


wecpipro_menu_id = readCookie('wecpipro_menu');
if (!wecpipro_menu_id) wecpipro_menu_id=0;
//wecpipro_menu_id=0;
jQuery(".mainmenu").eq(wecpipro_menu_id).trigger('click').trigger('mouseleave');

	function set_active_import_page(activepage,menuidx) {
				h=activepage.outerHeight()+50;
				//alert(activepage.index());
				jQuery(".sub_import_container").eq(menuidx).css({'height':h});
				
				chh=jQuery(".magpie_page.active").outerHeight()+jQuery("#wecpiheader").outerHeight()+60;
	
				jQuery("#magpiewrapper").css({'height':chh});
	
				
			}
			
			
			
			jQuery(".menuitem").click(function(){
	
					
		
	
					menuitem=jQuery(this).index();
					menu=jQuery(this).parent();
					menuidx = menu.index(".magpiemenu");
					menu.find(".menuitem.active").removeClass("active");
					jQuery(this).addClass("active");
					
					oldpage=jQuery(".sub_import_container").eq(menuidx).find(".sub_import_page.active");
					oldpage.removeClass("active");
					
					activepage=jQuery(".sub_import_container").eq(menuidx).children(".sub_import_page").eq(menuitem);
					activepage.addClass("active");
					
					//alert(menuidx);
				/*	menu=menu.find(".menuitem.active");
	
					idx = jQuery(".menuitem.active").index();
					jQuery(".menuitem.active").removeClass("active");
					jQuery(this).addClass("active");

					
					//subpage=jQuery(".sub_import_container").eq(menuidx);
					oldpage=jQuery(".sub_import_container").eq(menuidx).find(".sub_import_page.active");
					t = oldpage.outerHeight();
					
					if (t) t=100;
					
					if (t) oldpage.removeClass("active").stop(true).animate(
									{ top:t,opacity:0 },
									{	duration: 600,
										//easing:"easeOutCirc", 
										complete: function() {jQuery(this).hide();}
									});
					activepage=jQuery(".sub_import_container").eq(menuidx).children(".sub_import_page").eq(menuitem);
					activepage.addClass("active");
					activepage.show().stop(true).animate(
									{ top:0,opacity:1 },
									{
										duration: 500, 
										//easing:"easeOutBack", 
										complete: function() {}
									});
				*/
				//	set_active_import_page(activepage,menuidx);
					eraseCookie('wecpipro_menu_import'+menuidx);
					createCookie('wecpipro_menu_import'+menuidx,menuitem,1000);
					return false;
			});
			
			
			
	var maxheight=0;
		
		
			
			jQuery(".sub_import_container").each(function(k,v){
				
				menuidx = readCookie('wecpipro_menu_import'+k);
				if (menuidx<0) menuidx=0;
				if (!menuidx) menuidx=0;
				//menuidx=0;
				
				//alert (k+' '+menuidx);
				//jQuery(this).eq(wecpipro_menu_import_id);
				//$activepage=jQuery(".sub_import_container").eq(k).children(".sub_import_page").eq(menuidx);
				//jQuery(".sub_import_container").eq(k).find(".sub_import_page").eq(0).addClass("active");
				jQuery(".magpiemenu").eq(k).find(".menuitem").eq(menuidx).addClass("active").trigger("click");
				//activepage=jQuery(".sub_import_container").eq(k).children(".sub_import_page").eq(menuidx);
				//set_active_import_page(activepage,menuidx);
				//
				//set_active_import_page($activepage,menuidx);
				});
	
				
/*


jQuery(".hoverhelp").hover(function() {

	var classNo = jQuery(this).find("span").attr('class');
	h = ".hoverhelp"+classNo;
	jQuery(h).stop(true).addClass("active");

},function() {
	var classNo = jQuery(this).find("span").attr('class');
	var h = ".hoverhelp"+classNo;
	jQuery(h).stop(true).animate(
    
	{ opacity:1 }, // what we are animating
    {
        duration: 2000, // how fast we are animating
		complete: function() {jQuery(h).removeClass("active");}
	});
	}
);
*/



/*

jQuery(".balloon").hover(function() {

	jQuery(this).find('.balloonthis').show();

},function() {
	jQuery(this).find('.balloonthis').hide();
	}
);
*/


/*
		jQuery(".magpie_page")
		.eq(0)
		.addClass("active")
		.show()
		.fadeTo(1000,1);
	*/	/*
		.animate(
		
			{ opacity:1,top:100 }, 
			{
				duration: 1200, 
				complete: function() {}
			});
*/

		

//wecpiheight=maxheight+260+'px';
//jQuery(".wecpi_center").css({'height':wecpiheight});













//alert(typeof do_not_show_csv_file_list === 'undefined'); 
if (typeof do_not_show_delete_all_csv === 'undefined') jQuery(".do_not_show_delete_all_csv").html("");
if (typeof do_not_show_csv_file_list === 'undefined') jQuery(".do_not_show_csv_file_list").html('<div class="infobox">Information: You do not have any CSV files exported. Once you have CSV file(s) exported they will be listed right here.</div>');



/*
var iprod;

jQuery('.magpie_image_selected').click(function(){
	
	iprod=jQuery('.exported_table .magpie_image_selected').index(this);
	//iprod=jQuery(this).index();
	
	jQuery('#magpiedebug').html(iprod);
	if (jQuery(this).hasClass('active')) 
	{
	//alert(jQuery('.magpie_select_images .active').hasClass('active'));
		jQuery('.magpie_select_images.active').removeClass('active').slideToggle(200,'easeOutBack');
		jQuery('.magpie_image_selected.active').removeClass('active');
		return;
	//jQuery('.magpie_image_selected').removeClass('active').slideToggle(200,'easeOutBack');
	}
	jQuery('.magpie_select_images.active').removeClass('active').slideToggle(200,'easeOutBack');
	jQuery('.magpie_image_selected.active').removeClass('active');
	jQuery('.magpie_select_images').eq(iprod).addClass('active').slideToggle(500,'easeOutBack');
	jQuery(this).addClass('active');
	
	});

jQuery('.magpie_select_images .imgrow').click(function(){
	//i=jQuery('.magpie_select_images .imgrow').index(this);
	//is=jQuery('.magpie_select_images.active').index();
	//alert(is);
	i=jQuery(this).index();
	jQuery('#magpiedebug').html(iprod);
//	jQuery('.customselector').eq(jQuery('.magpie_image_selected.active').index()).
	im=jQuery(this).html();
	jQuery('#magpiedebug').append('-'+i);
	
	$s=jQuery(this);
	//jQuery(this).next('select option[selected]').removeClass('active');
	jQuery('.magpie_select_images .imgrow').removeClass('selected');
	jQuery(this).addClass('selected');
	jQuery('.magpie_image_selected').eq(iprod).html(im);
	
	
	$j=jQuery('select.customselect').eq(iprod).find('option');
	$j.removeAttr("selected");
	$j.eq(i).attr("selected", "selected");
	
	//$chgform=jQuery('.customselector').eq(iprod);
	//alert(jQuery('.magpie_image_selected.active').index());
	//$chgform("select option[selected]").removeAttr("selected");
	
	
//	jQuery('.magpie_select_images').eq(i).slideToggle(500,'easeOutBack');
	});
*/



}); /*End jQuery(document).ready(function()*/
	





function magpiepadnumber(numNumber, numLength){
	var strString = '' + numNumber;
	while(strString.length<numLength){
		strString = '0' + strString;
	}
	return strString;
}
function getCalendarDate()
{
   var months = new Array(13);
   months[0]  = "January";
   months[1]  = "February";
   months[2]  = "March";
   months[3]  = "April";
   months[4]  = "May";
   months[5]  = "June";
   months[6]  = "July";
   months[7]  = "August";
   months[8]  = "September";
   months[9]  = "October";
   months[10] = "November";
   months[11] = "December";
   var now         = new Date();
   var monthnumber = now.getMonth()+1;
   var monthname   = months[monthnumber];
   var monthday    = now.getDate();
   var year        = now.getYear();
   if(year < 2000) { year = year + 1900; }
   
   var dateString = year +
                    '.' +
					magpiepadnumber(monthnumber,2) +
					'.' +
                    magpiepadnumber(monthday,2);
   return dateString;
} // function getCalendarDate()

function getClockTime()
{
   var now    = new Date();
   var hour   = now.getHours();
   var minute = now.getMinutes();
   var second = now.getSeconds();
   var ap = "AM";
   if (hour   > 11) { ap = "PM";             }
   if (hour   > 12) { hour = hour - 12;      }
   if (hour   == 0) { hour = 12;             }
   if (hour   < 10) { hour   = "0" + hour;   }
   if (minute < 10) { minute = "0" + minute; }
   if (second < 10) { second = "0" + second; }
   var timeString = magpiepadnumber(hour,2) +
                    '.' +
                    magpiepadnumber(minute,2) +
                    '.' +
                    magpiepadnumber(second,2) +
                    "." +
                    ap;
   return timeString;
} // function getClockTime()

	
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

	

	
	
/*ToolTips*/
// initialize tooltip
jQuery("#topnews").tooltip({

   // tweak the position
   offset: [10, 2],

   // use the "slide" effect
   effect: 'slide'

// add dynamic plugin with optional configuration for bottom edge
});





function sprintf () {
    // http://kevin.vanzonneveld.net
    // +   original by: Ash Searle (http://hexmen.com/blog/)
    // + namespaced by: Michael White (http://getsprink.com)
    // +    tweaked by: Jack
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Paulo Freitas
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: sprintf("%01.2f", 123.1);
    // *     returns 1: 123.10
    // *     example 2: sprintf("[%10s]", 'monkey');
    // *     returns 2: '[    monkey]'
    // *     example 3: sprintf("[%'#10s]", 'monkey');
    // *     returns 3: '[####monkey]'
    var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuidfegEG])/g;
    var a = arguments,
        i = 0,
        format = a[i++];

    // pad()
    var pad = function (str, len, chr, leftJustify) {
        if (!chr) {
            chr = ' ';
        }
        var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
        return leftJustify ? str + padding : padding + str;
    };

    // justify()
    var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length;
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = pad(value, minWidth, customPadChar, leftJustify);
            } else {
                value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
            }
        }
        return value;
    };

    // formatBaseX()
    var formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        // Note: casts negative numbers to positive ones
        var number = value >>> 0;
        prefix = prefix && number && {
            '2': '0b',
            '8': '0',
            '16': '0x'
        }[base] || '';
        value = prefix + pad(number.toString(base), precision || 0, '0', false);
        return justify(value, prefix, leftJustify, minWidth, zeroPad);
    };

    // formatString()
    var formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision != null) {
            value = value.slice(0, precision);
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
    };

    // doFormat()
    var doFormat = function (substring, valueIndex, flags, minWidth, _, precision, type) {
        var number;
        var prefix;
        var method;
        var textTransform;
        var value;

        if (substring == '%%') {
            return '%';
        }

        // parse flags
        var leftJustify = false,
            positivePrefix = '',
            zeroPad = false,
            prefixBaseX = false,
            customPadChar = ' ';
        var flagsl = flags.length;
        for (var j = 0; flags && j < flagsl; j++) {
            switch (flags.charAt(j)) {
            case ' ':
                positivePrefix = ' ';
                break;
            case '+':
                positivePrefix = '+';
                break;
            case '-':
                leftJustify = true;
                break;
            case "'":
                customPadChar = flags.charAt(j + 1);
                break;
            case '0':
                zeroPad = true;
                break;
            case '#':
                prefixBaseX = true;
                break;
            }
        }

        // parameters may be null, undefined, empty-string or real valued
        // we want to ignore null, undefined and empty-string values
        if (!minWidth) {
            minWidth = 0;
        } else if (minWidth == '*') {
            minWidth = +a[i++];
        } else if (minWidth.charAt(0) == '*') {
            minWidth = +a[minWidth.slice(1, -1)];
        } else {
            minWidth = +minWidth;
        }

        // Note: undocumented perl feature:
        if (minWidth < 0) {
            minWidth = -minWidth;
            leftJustify = true;
        }

        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite');
        }

        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type == 'd') ? 0 : undefined;
        } else if (precision == '*') {
            precision = +a[i++];
        } else if (precision.charAt(0) == '*') {
            precision = +a[precision.slice(1, -1)];
        } else {
            precision = +precision;
        }

        // grab value using valueIndex if required?
        value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

        switch (type) {
        case 's':
            return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
        case 'c':
            return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
        case 'b':
            return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'o':
            return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'x':
            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'X':
            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
        case 'u':
            return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'i':
        case 'd':
            number = (+value) | 0;
            prefix = number < 0 ? '-' : positivePrefix;
            value = prefix + pad(String(Math.abs(number)), precision, '0', false);
            return justify(value, prefix, leftJustify, minWidth, zeroPad);
        case 'e':
        case 'E':
        case 'f':
        case 'F':
        case 'g':
        case 'G':
            number = +value;
            prefix = number < 0 ? '-' : positivePrefix;
            method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
            textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
            value = prefix + Math.abs(number)[method](precision);
            return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
        default:
            return substring;
        }
    };

    return format.replace(regex, doFormat);
}



/**
 * jquery.dump.js
 * @author Torkild Dyvik Olsen
 * @version 1.0
 * 
 * A simple debug function to gather information about an object.
 * Returns a nested tree with information.
 * 
 */
 /*
(function($) {

jQuery.fn.dump = function() {
   return $.dump(this);
}

jQuery.dump = function(object) {
   var recursion = function(obj, level) {
      if(!level) level = 0;
      var dump = '', p = '';
      for(i = 0; i < level; i++) p += "\t";
      
      t = type(obj);
      switch(t) {
         case "string":
            return '"' + obj + '"';
            break;
         case "number":
            return obj.toString();
            break;
         case "boolean":
            return obj ? 'true' : 'false';
         case "date":
            return "Date: " + obj.toLocaleString();
         case "array":
            dump += 'Array ( \n';
            $.each(obj, function(k,v) {
               dump += p +'\t' + k + ' => ' + recursion(v, level + 1) + '\n';
            });
            dump += p + ')';
            break;
         case "object":
            dump += 'Object { \n';
            $.each(obj, function(k,v) {
               dump += p + '\t' + k + ': ' + recursion(v, level + 1) + '\n';
            });
            dump += p + '}';
            break;
         case "jquery":
            dump += 'jQuery Object { \n';
            $.each(obj, function(k,v) {
               dump += p + '\t' + k + ' = ' + recursion(v, level + 1) + '\n';
            });
            dump += p + '}';
            break;
         case "regexp":
            return "RegExp: " + obj.toString();
         case "error":
            return obj.toString();
         case "document":
         case "domelement":
            dump += 'DOMElement [ \n'
                  + p + '\tnodeName: ' + obj.nodeName + '\n'
                  + p + '\tnodeValue: ' + obj.nodeValue + '\n'
                  + p + '\tinnerHTML: [ \n';
            jQuery.each(obj.childNodes, function(k,v) {
               if(k < 1) var r = 0;
               if(type(v) == "string") {
                  if(v.textContent.match(/[^\s]/)) {
                     dump += p + '\t\t' + (k - (r||0)) + ' = String: ' + trim(v.textContent) + '\n';
                  } else {
                     r--;
                  }
               } else {
                  dump += p + '\t\t' + (k - (r||0)) + ' = ' + recursion(v, level + 2) + '\n';
               }
            });
            dump += p + '\t]\n'
                  + p + ']';
            break;
         case "function":
            var match = obj.toString().match(/^(.*)\(([^\)]*)\)/im);
            match[1] = trim(match[1].replace(new RegExp("[\\s]+", "g"), " "));
            match[2] = trim(match[2].replace(new RegExp("[\\s]+", "g"), " "));
            return match[1] + "(" + match[2] + ")";
         case "window":
         default:
            dump += 'N/A: ' + t;
            break;
      }
      
      return dump;
   }
   
   var type = function(obj) {
      var type = typeof(obj);
      
      if(type != "object") {
         return type;
      }
      
      switch(obj) {
         case null:
            return 'null';
         case window:
            return 'window';
         case document:
            return 'document';
         case window.event:
            return 'event';
         default:
            break;
      }
      
      if(obj.jquery) {
         return 'jquery';
      }
      
      switch(obj.constructor) {
         case Array:
            return 'array';
         case Boolean:
            return 'boolean';
         case Date:
            return 'date';
         case Object:
            return 'object';
         case RegExp:
            return 'regexp';
         case ReferenceError:
         case Error:
            return 'error';
         case null:
         default:
            break;
      }
      
      switch(obj.nodeType) {
         case 1:
            return 'domelement';
         case 3:
            return 'string';
         case null:
         default:
            break;
      }
      
      return 'Unknown';
   }
   
   return recursion(object);
}

function trim(str) {
   return ltrim(rtrim(str));
}

function ltrim(str) {
   return str.replace(new RegExp("^[\\s]+", "g"), "");
}

function rtrim(str) {
   return str.replace(new RegExp("[\\s]+$", "g"), "");
}

})(jQuery);

*/

/*	


	function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}
*/
