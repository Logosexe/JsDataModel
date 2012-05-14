<!DOCTYPE html> 
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- 
	Hey there wanderer! You like looking on to the dark side? So do I. I always do that.
	Nothing interesting here ^ ^
-->

<title>jQuery & Js Data Model for Your Ajax forms</title>
<meta name="description" content="JS & JQuery Data Model for sending ajax forms" />
<meta name="keywords" content="javascript,ajax,data,model" />
<link rel="shortcut icon" href="favicon.ico" />

<link href="css/style.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.slidinglabels.js" type="text/javascript"></script>

<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="dataModel.js"></script>

<script type="text/javascript">
$(function(){

	$('#contactform').slidinglabels({
		topPosition  : '8px', 
		leftPosition : '8px',
		axis         : 'x',
		speed        : 'fast'

	});

	$('#contactform').submit(function(){		
		model = new DataModel;
		model.emptyCheckBoxVal = 'OFF'; 
		model.dataType = 'text';
		model.gatherData('#contactform');
		callback = function(json){
			console.log(json);
			$('#ajaxoutput').html(json)
		}
		model.post(callback);
		
		return false;
	});
	
});
</script>
<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-20915846-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
</head>

<body>
<div class="container">
        <div id="sidenav">
            
       	<ul>
            <li><a class="home" href="#home">Home</a></li>
            <li><a class="portfolio" href="#form">Form</a></li>
            <li><a class="portfolio" href="#docs">Documentation</a></li>
			<li><a class="services" href="#download">Download</a></li>
			<li><a class="portfolio" href="#requirements">Requirments</a></li>
            <li><a class="contact" style="border-bottom: 0;" href="#contact">Contact</a></li>
        </ul>
        

        <div id="social">
            <div class="social_facebook"><a href="http://www.facebook.com/logthis" title="" target="_blank">&nbsp;</a></div>
            <div class="social_twitter"><a href="http://twitter.com/|_ogos" title="" target="_blank">&nbsp;</a></div>
<!--
            <div class="social_lastfm"><a href="http://www.last.fm/" title="">&nbsp;</a></div>
            <div class="social_flickr"><a href="http://www.flickr.com/" title="">&nbsp;</a></div>
-->

        </div>
        
        <div id="footer">
            &copy; log-this.com 2012
        </div>
    </div>

    <a name="home"></a>

    <div id="content">
            <h2>JQuery & JS Data Model v0.9</h2>
            <p>Hey, first of all the graphics and css of this page aren't mine (downloaded from free templates:P), i don't make any frontend stuff beside cool javascripts.</p>
            
            <p>This tool is for all the people who need to make some ajaxs forms working and who don't have time to script all the form inputs. With this script it will be simple as that:<br/>
            <i>model = new DataModel();</i></br>
            <i>model.gatherData('#formId')</i></br>
            <i>model.post();</i></br>
            And thats all! No matter how much inputs, checkboxes and other stuff you have in you form, it will send those! Now check out the form, fill it and try to send, the output will be seen below.
            </p>

            

    
    <a name="form"></a>
            
            <h2>The Form</h2>
            
            <p id="form-desc">The script that is nedded:</br>
            
            <i>$('#form').submit(function(){</br>
				model = new DataModel;</br>
				model.emptyCheckBoxVal = 'OFF';</br>
				model.gatherData('#form');</br></br>
				callback = function(json){</br>
				console.log(json);</br>
				}</br>
		
				model.post(callback);</br>
		
				return false;</br>
				});
			</i>
            
            </p>


             <form action="post.php" method="post" id="contactform">
                <div id="name-wrap" class="slider"> 
                    <label for="name">Name</label> 
                    <input type="text" id="name" name="user[name]" /> 
                </div>
                
                <div id="email-wrap"  class="slider"> 
                    <label for="email">E&ndash;mail</label> 
                    <input type="text" id="email" name="user[email][mail]" /> 
                </div>
                
				<div id="email-wrap"  class="slider"> 
                    <label for="email">Prefix</label> 
                    <input type="text" id="email" name="user[email][prefix][name]" /> 
                </div>
                
                <div id="phone-wrap"  class="slider"> 
                    <label for="phone">Phone</label> 
                    <input type="text" id="phone" name="phone" /> 
                </div> 
                
                <div id="url-wrap"  class="slider"> 
                    <label for="url">URL</label> 
                    <input type="text" id="url" name="url" /> 
                </div> 
                
                <div id="comment-wrap"  class="slider"> 
                    <label for="comment">Comment</label> 
                    <textarea cols="53" rows="10" id="comment" name="comment"></textarea> 
                </div> 
                
				<div id=""  class="checkboxes"> 
                    <label for="checkbox">checkbox</label> 
                    <input type="checkbox" id="checkbox" name="checkbox" value="1"/> 
                    
                    <label for="checkbox2">checkbox2</label> 
                    <input type="checkbox" id="checkbox2" name="checkbox2" value="2"/>
                </div> 
				<div class="clearall"></div>              
				<div class="radios">
					<label for="radio">radio</label> 
                    <input type="radio" id="radio" name="radio" value="1"/>
					<label for="radio2">radio</label> 
                    <input type="radio" id="radio2" name="radio" value="2"/> 
				</div>
				<div class="clearall"></div>
				<div style="height:40px">
					<label for="radio">And some ugly select:</label> 
					<select name="select">
						<option value="option1">option1</option>
						<option value="option2">option2</option>
						<option value="option3">option3</option>
					</select>
				</div>
				
				<div><button type="submit" id="btn" name="btn">Submit</button></div>
                
            </form>
            <div class="clearall"></div>
            <div id="portfolio">
            
            </div>
            
            <p>Output from the php file that does echo json_encode($_POST):</p><pre id="ajaxoutput"></pre>

    

    <a name="docs"></a>
            
            <h2>Documentation</h2>
            
            <p>We have here some basic function, not much...</p>
            
              <h3>Functions</h3>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th></th>
                    <th>Params</th>
                    <th>Description</th>
                    <th>Return</th>
                </tr>
                <tr>
                    <td class="textright">gatherData()</td>
                    <td> - </td>
                    <td>the main function to collect all data from the form</td>
                    <td>object - all the data</td>
                </tr>
                <tr>
                    <td class="textright">mergeDataWithObject()</td>
                    <td>object</td>
                    <td>if you need to add something extra to post u can do it by this method</td>
                    <td> - </td>
                </tr>
                <tr>
                    <td class="textright">post()</td>
                    <td>function(json) - success callback</td>
                    <td>this method will send all the data to the desired place and run the function passed to itself</td>
                    <td> - </td>
                </tr>
                </table>
                <h3>Properties</h3>
               <table cellpadding="0" cellspacing="0">
				<tr>
                    <th></th>
                    <th>Type</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="textright">ajaxUrl</td>
                    <td> string </td>
                    <td> if not set, model will take the actin from form</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="textright">headers</td>
                    <td> object </td>
                    <td> if you need to send some extra headers, set theme here</td>
                    <td></td>
                </tr>
				<tr>
                    <td class="textright">type</td>
                    <td> string ('POST' | 'GET' | 'PUT' | 'DELETE') </td>
                    <td> type of request</td>
                    <td></td>
                </tr>
				<tr>
                    <td class="textright">dataType</td>
                    <td> string ('json' | 'text') </td>
                    <td> type of response</td>
                    <td></td>
                </tr>
				<tr>
                    <td class="textright">emptyCheckBoxVal</td>
                    <td> string </td>
                    <td> if set to '' empty checkbox wont be sent, otherwise the value specified for emptyCheckBoxVal will be sent</td>
                    <td></td>
                </tr>
			</table>

    
  	<a name="download"></a>
  	
  			<h2>Download</h2>
  			this whole page because it looks good ^ ^
  			<a href="https://github.com/Logosexe/JsDataModel" target="_blank">https://github.com/Logosexe/JsDataModel</a></br>
  			or just get the dataModel.js and start testing it!
  
  
  	<a name="requirements"></a>
  	
  			<h2>Requirements</h2>
  			jQuery >= 1.6.2 - i didn't test it below this but it should work
  			
    <a name="contact"></a>
            
            <h2>Contact Me</h2>
            
    		You can catch me @ <a href="http://log-this.com" target="_blank">log-this.com</a></br>
    		Follow Me on Twitter @logos_dev <a href="https://twitter.com/logos_dev" target="_blank">https://twitter.com/logos_dev</a>
            
            
            
            <div class="clearall"></div>
            
            <div id="footfiller">
            </div>
            
    </div>
    
</div>
</body>
</html>