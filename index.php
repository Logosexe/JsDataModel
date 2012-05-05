<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<meta charset=utf-8 /> 
	<meta name="viewport" content="width=960" /> 
	<title></title> 
	
	<link rel="stylesheet" href="main.css" type="text/css" /> 

	<script src="jquery.min.js"></script>
	<script src="dataModel.js"></script>
	
	<style type="text/css"> 
	</style>
	
</head> 
<body>

	<section id="content"> 
		<header> 
			<h1>JS Data Model Demo</h1>
		</header>  
		<section class="form">
			<form id="test-form" action="post.php">
				<input name="sample-name"/>
				<input name="gr1[sample-name]"/>
				<input name="gr1[sample-name1]"/>
				<input name="gr1[sample-name2]"/>
				<input type="checkbox" name="checkboxName" value="10"/>
				
				<input type="radio" name="radio" value="2"/>
				<input type="radio" name="radio" value="3"/>
				
				<select name="selectName">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
				<input type="submit"/>
			</form>

		</section>
 	</section>
 	
 	
	<script type="text/javascript">
	
	$('#test-form').submit(function(){		
		
		model = new DataModel;
		//model.ajaxUrl = 'post.php'; // if not specified model will take the form action attr
		model.type = 'POST'; // default post
		model.emptyCheckBoxVal = 'OFF'; // set to empty string to disable sending not checked checkboxes
		
		model.gatherData('#test-form');
		
		/*
			The callback function to operate on server respond, takes one parametr the json object, or string if post type is set to text
		*/
		
		callback = function(json){
			console.log(json);
		}
		
		model.post(callback);
		
		return false;
	});			
	</script> 
 
 

</body> 
</html> 