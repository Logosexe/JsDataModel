/**

Created By Logos
visit me at http://log-this.com


Data Model version: 0.9;

TODO:
x error handling
x validation rules


Specification
This small script (4kb in compressed file) is a powerfull tool for working with ajax forms,
it can easily collect all needed data from form and send it to server.

jQuery compatibile:
This plugin was tested on those verions of jquery, it should work on all other.
1.7.2
1.6.2


Change log:


0.9:
- added support for multiple groups name[gr1][subgr][..][name] 
- added [] group handling


0.8:
- fixed bug with radio
- added suport for groups


0.2-0.7 
not realesed as dists, many logical fixes that i dont realy remember :P

0.1
-initial collecting of data

*/

var DEBUG = true;

const gather_data_fail = 0;

var DataModel = function() {
	this.ajaxUrl = null;
	this.headers = null;
	this.type = 'POST';
	this.dataType = 'json';
	this.postData = null;
	this.emptyCheckBoxVal = 'OFF';
	this.form = null;
	
	/* Error handling */
	this.errorArrayName = '';
	
	this.setRootForm = function(sel){
		if((typeof sel == 'string' && $(sel).length > 0) || $(sel).length > 0){
			this.form = $(sel);
			return true;
		}
		
		return false;
	}
	
	this.gatherData = function(sel){

		if(this.setRootForm(sel)){
			data = new Array();

			data[0] = $(this.form).find('input[type!=radio]');
			data[1] = $(this.form).find('textarea');
			data[2] = $(this.form).find('select');
			data[3] = $(this.form).find('input[type=radio]:checked');

			var postData = {};
			var emptyCheckBoxVal = this.emptyCheckBoxVal;
			
			var stack = null
			var emptyGroupId = 0;
			$.each(data, function(i,v) {
				if(v[0] != undefined) { 
					if(postData == null)
						postData = {};
					$.each(v, function(j,obj){
						var name = null;
					
						/*	Grouped inputs */
						if($(obj).attr('name'))
						if($(obj).attr('name').indexOf('[', 0) != -1) {
						
							/* if we got checkbox and now empty checkbox val then continue */
							if($(obj).attr('type') == 'checkbox' && emptyCheckBoxVal == '') return true; 
						
							/* handle [] group */ 
						
							attr = $(obj).attr('name');
							
							if(/\[\]/g.test(attr)){
								name = emptyGroupId;
								emptyGroupId++;
							}
						
							attr = attr.split('[');
							
							group = attr[0];
							
						//	if(name === null) name = attr[1].replace(']', '');
							
							if(attr.length > 2){
								if(name === null) name = attr[attr.length -1].replace(']', '');
								attr = attr.slice(1, attr.length);
								var a = {}
								
								$.each(attr.reverse(), function(i,v){
									v = v.replace(']', '');
									attr[i] = v;
									
									if(i == 0) {
										if($(obj).attr('type') == 'checkbox') {
											if($(obj).attr('checked') == true || $(obj).attr('checked') == 'checked') {
												//a[v] = $(obj).val();
												a[name] = $(obj).val();
											} else {
												//a[v] = emptyCheckBoxVal;
												a[name] = $(obj).val();
											}
										} else {
											//a[v] = $(obj).val();
											a[name] = $(obj).val();
										}
									}
									else {
										b = a;
										a = {}
										a[v] = b;
									}
								});
								

								
								if(stack == null){
									stack = a;
								} else {
									stack = stack.merge(a);
								}
							} else {
								name = attr[1].replace(']', '');
								if(postData[group] == undefined)
									postData[group] = {};
									
								if($(obj).attr('type') == 'checkbox') {
									if($(obj).attr('checked') == true || $(obj).attr('checked') == 'checked') {
										if(postData[group][name] == undefined)
											postData[group][name] = {};
											
										postData[group][name][j] = $(obj).val();
										
									} else if(emptyCheckBoxVal != ''){
										if(postData[group][name] == undefined)
											postData[group][name] = {};
											
										postData[group][name][j] = emptyCheckBoxVal;
									}
								} else
									postData[group][name] = $(obj).val();
							}
						} else 
							/* Simple name without group */
							if($(obj).attr('type') == 'checkbox') {
								if($(obj).attr('checked') == true || $(obj).attr('checked') == 'checked') {
									if(postData[$(obj).attr('name')] == undefined)
										postData[$(obj).attr('name')] = {};
									postData[$(obj).attr('name')] = $(obj).val();
								} else if(emptyCheckBoxVal != ''){
									if(postData[$(obj).attr('name')] == undefined)
										postData[$(obj).attr('name')] = {};
									postData[$(obj).attr('name')] = emptyCheckBoxVal;
								}
							} else
								postData[$(obj).attr('name')] = $(obj).val();
					});
					
					
					
				}
			});


			postData = jQuery.extend(postData, stack);
			if(postData == null)
				this.postData = gather_data_fail;
			else {
				this.postData = postData;
			}
				
		} else if(DEBUG == true) {
			console.log('WARNING: object passed to gatherData doesn\'t exist');
		}
		
		
		return postData;
	}
	


	this.mergeDataWithObject = function(obj){
		this.postData = jQuery.extend(this.postData, obj);
	}

	this.post = function(successCallback) {
		/*
			Check if ajax url is setted, if not try to take the form action param
		*/
	
/*
		if(this.postData == gather_data_fail){
			if(DEBUG == true) {
				console.log('failed to gather data')
			}
			return false;
		}	
*/
	
		if(this.ajaxUrl == null || this.ajaxUrl == ''){
			this.ajaxUrl = this.form.attr('action');
		}
		var errorArrayName = this.errorArrayName;
		if(this.ajaxUrl != null && this.ajaxUrl != '' && this.postData != null) {
			$.ajax({
				url: this.ajaxUrl,
				type: this.type,
				data : this.postData,
				dataType: this.dataType,
				headers : this.headers,
				success: function(json) {
			/* error handling … */
/*
					if(json.errors){
						$.each(json.errors, function(i, v){
						console.log(i)
							$(i).css('border', '1px solid red')
						})
					}
*/
				
					if(successCallback)
						successCallback(json);
				}, 
				error : function(e){
					if(DEBUG == true) {
						console.log('WARNING: ajaxUrl or response is invalid');
					}
				}
			});
		} else if(DEBUG == true) {
			response = '';
			if(this.ajaxUrl == null || this.ajaxUrl == '')
				response += 'ajaxUrl is not defined';
			if(this.postData == gather_data_fail)
				response += 'postData is empty after atempt to gather data';
			console.log('WARNING: '+response);
			return false;
		}
	}
}


Object.defineProperty(Object.prototype, "merge", {
    enumerable: false,
    value: function () {
        var override = true,
            dest = this,
            len = arguments.length,
            props, merge, i, from;

        if (typeof(arguments[arguments.length - 1]) === "boolean") {
            override = arguments[arguments.length - 1];
            len = arguments.length - 1;
        }

        for (i = 0; i < len; i++) {
            from = arguments[i];
            if (from != null) {
                Object.getOwnPropertyNames(from).forEach(function (name) {
                    var descriptor;

                    // nesting
                    if ((typeof(dest[name]) === "object" || typeof(dest[name]) === "undefined")
                            && typeof(from[name]) === "object") {

                        // ensure proper types (Array rsp Object)
                        if (typeof(dest[name]) === "undefined") {
                            dest[name] = Array.isArray(from[name]) ? [] : {};
                        }
                        dest[name].merge(from[name], override);
                    } 

                    // flat properties
                    else if ((name in dest && override) || !(name in dest)) {
                        descriptor = Object.getOwnPropertyDescriptor(from, name);
                        if (descriptor.configurable) {
                            Object.defineProperty(dest, name, descriptor);
                        }
                    }
                });
            }
        }
        return this;
    }
});
