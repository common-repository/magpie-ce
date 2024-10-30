/************************************************ 
*  jQuery iphoneSwitch plugin                   *
*                                               *
*  Author: Daniel LaBare                        *
*  Date:   2/4/2008                             *
* 	Modified by geegood.com/wordpress/ Neil Urich Reinwald
************************************************/

jQuery.fn.iphoneSwitch = function(start_state, switched_on_callback, switched_off_callback, options, confirmthis) {

	var state = start_state == 'on' ? start_state : 'off';

	//var state=start_state_callback();
	// define default settings
	var settings = {
		mouse_over: 'pointer',
		mouse_out:  'default',
		switch_on_container_path: '/wp-content/plugins/magpie/images/iphoneswitch/iphone_switch_container_on.png',
		switch_off_container_path:'/wp-content/plugins/magpie/images/iphoneswitch/iphone_switch_container_off.png',
		switch_path: 		'/wp-content/plugins/magpie/images/iphoneswitch/iphone_switch.png',
		switch_height: 27,
		switch_width: 94
	};

	if(options) {
		jQuery.extend(settings, options);
	}
	// create the switch
	return this.each(function() {

		var container;
		var image;
		//state=jQuery(this).attr("name");alert(state);

		// make the container
		container = jQuery('<span class="iphone_switch_container" style="height:'+settings.switch_height+'px; width:'+settings.switch_width+'px; position: relative; overflow: hidden"></span>');
		
		// make the switch image based on starting state
		image = jQuery('<img class="iphone_switch" style="margin:10px;height:'+settings.switch_height+'px; width:'+settings.switch_width+'px; background-image:url('+settings.switch_path+'); background-repeat:none; background-position:'+(state == 'on' ? 0 : -53)+'px" src="'+(state == 'on' ? settings.switch_on_container_path : settings.switch_off_container_path)+'" /></div>');

		// insert into placeholder
		jQuery(this).html(jQuery(container).html(jQuery(image)));

		jQuery(this).mouseover(function(){
			jQuery(this).css("cursor", settings.mouse_over);
		});

		jQuery(this).mouseout(function(){
			jQuery(this).css("background", settings.mouse_out);
		});

		// click handling
		jQuery(this).click(function() {
			if(state == 'on') {
				jQuery(this).find('.iphone_switch').animate({backgroundPosition: -53}, "fast", function() {
					jQuery(this).attr('src', settings.switch_off_container_path);
					switched_off_callback();
				});
				state = 'off';
				jQuery(".ui-progressbar-value .vis").hide();
			}
			else {
				if (confirmthis) if (!confirm("Are you absolutely sure?")) return;
				jQuery(this).find('.iphone_switch').animate({backgroundPosition: 0}, "fast", function() {
					switched_on_callback();
				});
				jQuery(this).find('.iphone_switch').attr('src', settings.switch_on_container_path);
				state = 'on';
				jQuery(".ui-progressbar-value .vis").show();
			}
		});		

	});
	
};
