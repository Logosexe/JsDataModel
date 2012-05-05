/**

Created By Logos
visit me at http://log-this.com


Data Model version: 0.8;

TODO:
Write validation rules

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
			$.each(data, function(i,v) {
				if(v[0] != undefined) { 
					if(postData == null)
						postData = {};
					$.each(v, function(j,obj){
						if($(obj).attr('name'))
						if($(obj).attr('name').indexOf('[', 0) != -1) { 
							attr = $(obj).attr('name').split('[');
							group = attr[0];
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
						} else 
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
	
	this.post = function(successCallback) {
		/*
			Check if ajax url is setted, if not try to take the form action param
		*/
	
		if(this.ajaxUrl == null || this.ajaxUrl == ''){
			this.ajaxUrl = this.form.attr('action');
		}
		
		if(this.ajaxUrl != null && this.ajaxUrl != '' && this.postData != null) {
			$.ajax({
				url: this.ajaxUrl,
				type: this.type,
				data : this.postData,
				dataType: this.dataType,
				headers : this.headers,
				success: function(json) {
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
		}
	}
}
