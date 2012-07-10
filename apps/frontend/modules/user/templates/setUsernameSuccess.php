<div class="popin" id="username-form">
	<div>
		<h2>Choisir un pseudo</h2>
		<form id="form-setusername" class="form-large" action="<?php echo url_for('user/setUsername'); ?>" method="post">
			<input type="text" maxlength="12" class="required" name="username" />
			<span class="help">Entre 6 et 12 caractères sans espaces.</span>
			<input type="submit" value="Enregistrer" />
		</form>
	</div>
</div>

<script>
	var arrayUsers
	function inArray(array, p_val) {
	    var l = array.length;
	    for(var i = 0; i < l; i++) {
	        if(array[i] == p_val) {
	            return true;
	        }
	    }
	    return false;
	}

	$.ajax({
		url: "<?php echo  url_for('user/allUsername');?>",
		dataType:"json",
		success: function(data){
			arrayUsers = data;
		}
	});
			
	$.validator.addMethod(
	  "regex",
	   function(value, element, regexp) {
	       if (regexp.constructor != RegExp)
	          regexp = new RegExp(regexp);
	       else if (regexp.global)
	          regexp.lastIndex = 0;
	          return this.optional(element) || regexp.test(value);
	   },"Caractères alphanumérique uniquement."
	);
	$.validator.addMethod(
	  "uniqueUsername",
	   function(value, element, bool) {
	   	console.log(inArray(arrayUsers, value));
	   		return this.optional(element) || !inArray(arrayUsers, value.toLowerCase());	          
	   },"Caractères alphanumérique uniquement."
	);
	$(document).ready(function() {
	   	$("#form-setusername").validate({
	      	rules: {
	         "username":{
	            "required": true,
	           	"minlength": 6,
            	"maxlength": 12,
	            "regex": /^[a-zA-Z0-9-_]*$/,
	            "uniqueUsername": true
	         }
	       },
	       messages: {
	       	"username": {
	       		"required":'Ce champ est obligatoire',
	       		"regex":'Caractères alphanumérique uniquement.',
	       		"uniqueUsername":'Ce pseudo exist déjà'
	       	}
	       }
	  	});
	});

</script>