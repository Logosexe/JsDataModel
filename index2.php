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
			<h1>JS & JQ Data Model Demo</h1>
		</header>  
		<section class="form">
			<form id="test-form" action="post.php">
				<input name="sample-name"/>
				<input name="gr1[sample-name]"/>
				<input name="gr1[sample-name1]"/>
				<input name="gr1[sample-name2]"/>
				
				<input name="gr1[subgroup][subsubgroup][sub3gr1]" value="qe"/>
				<input name="gr1[subgroup][subsubgroup][sub3gr2]" value="qwr"/>
				<input name="gr1[subgroup][subsubgroup][sub3gr3]" value="asda"/>
				
				
				<input name="gr1[subgroup][subsubgrou2p][sub3gr1]" value="qe2"/>
				
				
				<input name="gr1[subgroup][subsubgroup3][]" value="auto1"/>
				<input name="gr1[subgroup][subsubgroup3][]" value="auto2"/>
				<input name="gr1[subgroup][subsubgroup3][]" value="auto3"/>
				
				<input type="checkbox" name="checkboxName" value="10"/>
				<input type="checkbox" name="checkboxName" value="20"/>
				<input type="checkbox" name="checkboxName" value="20"/>
				
				<input type="radio" name="radio" value="2"/>
				<input type="radio" name="radio" value="3"/>
				
				
				<input type="radio" name="radioGr[radio]" value="4"/>
				<input type="radio" name="radioGr[radio]" value="5"/>
				
				
				<select name="selectName">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
				
				<textarea name="textArea"></textarea>
				
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
		
		/* Error handling
		
			if post type is set as json, this data model can automaticaly handle errors,
			set the error array name 
			
			model.errorArray = 'errors'
		
		*/
		
		model.errorArrayName = 'errors';
		
		model.post(callback);
		
		return false;
	});			
	</script> 
 
 

</body> 
</html> 