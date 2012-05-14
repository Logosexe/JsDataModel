<!DOCTYPE html> 
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>jQuery & Js Data Model for Your forms</title>

<link rel="shortcut icon" href="favicon.ico" />

<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/pirobox_lightbox.css" type="text/css" rel="stylesheet" />


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/pirobox.min.js"></script>
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

</head>

<body>
<div class="container">
        <div id="sidenav">
            
       	<ul>
            <li><a class="home" href="#home">Home</a></li>
            <li><a class="portfolio" href="#portfolio">Form</a></li>
            <li><a class="services" href="#services">Documentation</a></li>
            <li><a class="contact" style="border-bottom: 0;" href="#contact">Contact</a></li>
        </ul>
        

        <div id="social">
<!--             <div class="social_facebook"><a href="http://www.facebook.com/" title="" target="_blank">&nbsp;</a></div> -->
            <div class="social_twitter"><a href="https://twitter.com/#!/l_ogos" title="" target="_blank">&nbsp;</a></div>
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
            <h2>JQuery & JS Data Model</h2>
            <p>Hey, first of all this page look isn't my, i don't do any frontend stuff beside cool javascripts. </p>
            
            <p>So whats it for? It's for all the people who need to make some ajaxs forms working and they don't have time
            to script all the form inputs. With this tool it will be simple as that:<br/>
            <i>model = new DataModel();</i></br>
            <i>model.gatherData('#formId')</i></br>
            <i>model.post();</i></br>
            And thats all! No matter how much inputs, checkboxes and other stuff you have in you form, it will send those!
            </p>

            

    
    <a name="portfolio"></a>
            
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
                
                <div><button type="submit" id="btn" name="btn">Submit</button></div>
                
            </form>
            <div class="clearall"></div>
            <div id="portfolio">
            
            </div>
            
            <p>Output from the php file that does echo json_encode($_POST):</p><pre id="ajaxoutput"></pre>

    

    <a name="services"></a>
            
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

    
  
    <a name="contact"></a>
            
            <h2>Contact Me</h2>
            
    		You can catch me @ <a href="http://log-this.com" target="_blank">log-this.com</a></br>
    		Follow Me on Twitter <a href="https://twitter.com/#!/l_ogos" target="_blank">https://twitter.com/#!/l_ogos</a>
            
            
            
            <div class="clearall"></div>
            
            <div id="footfiller">
            </div>
            
    </div>
    
</div>
</body>
</html>