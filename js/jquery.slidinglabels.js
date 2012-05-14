/*
	Sliding Labels 3.0
	
	This is the official plugin version of Sliding Labels.
	It is open source code by Tim Wright of CSSKarma.com
	Use as you see fit, I'd like it if you kept this in 
	the code, but basically share it and don't be a jerk.
	
	Support:
	http://www.csskarma.com/blog/sliding-labels-plugin
	
	Version: 2 - added textarea functionality
	Version: 3 - added axis parameter
	           - added speed parameter
	           - removed color parameter, as it should be define in the CSS
	           - added position:relative to wrapping element
	           - coverted to jQuery plugin
*/

(function($){  
$.fn.slidinglabels = function(options) { 
	var defaults = {
		topPosition  : '5px',
		leftPosition : '5px',
		axis         : 'x',
		speed        : 'fast'
	};
	
	var options = $.extend(defaults, options);
	var itemwrapper = this.children('.slider');
	var labels = itemwrapper.children('label');
	
	return labels.each(function() {
		obj = $(this);
		
		var parent = obj.parents('.slider');
		parent.css({'position':'relative'})
		
		// style the label with JS for progressive enhancement
		obj.css({
			'position' : 'absolute',
			'top'      : defaults.topPosition,
			'left'     : defaults.leftPosition,
			'display'  : 'inline',
			'z-index'  : 99
		});
		
		var inputval = $(this).next().val();
		var labelwidth = $(this).width();
		var labelmove = labelwidth + 5 +'px';
		var labelheight = $(this).height();
		
		//onload, check if a field is filled out, if so, move the label out of the way
		if(inputval !== ''){
			if(defaults.axis == 'x'){
				obj.stop().animate({ 'left':'-'+labelmove }, 1);
			} else if(defaults.axis == 'y') {
				obj.stop().animate({ 'top':'-'+labelheight }, 1);
			}			
		} // 	
		
		// if the input is empty on focus move the label to the left
		// if it's empty on blur, move it back
		$('input, textarea').focus(function(){
			var label = $(this).prev('label');
			var width = label.width();
			var height = label.height();
			var adjust = width + 20 + 'px';
			var adjustUp = height + 'px';
			var value = $(this).val();
			
			if(value == ''){
				if(defaults.axis == 'x'){
					label.stop().animate({ 'left':'-'+adjust }, defaults.speed);
				} else if(defaults.axis == 'y') {
					label.stop().animate({ 'top':'-'+adjustUp }, defaults.speed);
				}
			} else {
				if(defaults.axis == 'x'){
					label.css({ 'left':'-'+adjust });
				} else if(defaults.axis == 'y') {
					label.css({ 'top':'-'+adjustUp });
				}
			}
			}).blur(function(){
				var label = $(this).prev('label');
				var value = $(this).val();
				
				if(value == ''){					
					if(defaults.axis == 'x'){
						label.stop().animate({ 'left': defaults.leftPosition }, defaults.speed);
					} else if(defaults.axis == 'y') {
						label.stop().animate({ 'top': defaults.topPosition }, defaults.speed);
					}					
				}
			});
		});  
	}; // End function
})(jQuery); // End jQuery