<div id="fb-root"></div>
<script>

window.fbAsyncInit = function() {
  	FB.init({
    	appId      : '<?php echo sfconfig::get('app_facebook_app_id');?>',
    	status     : true, 
    	cookie     : true,
    	xfbml      : true,
    	oauth      : true,
  	});

};
(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fr_FR/all.js#appId=<?php echo sfconfig::get('app_facebook_app_id');?>&xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

	$(document).ready(function(){
		$('.facebookLogin').click(function(){
			 FB.login(function(response) {
			   if (response.authResponse) {
			     //console.log('Welcome!  Fetching your information.... ');
			     FB.api('/me', function(response) {
			       //console.log(response);
			       $.ajax({
					  url: "<?php echo  url_for('ajax_facebook_connect');?>",
					  data: response,
					  dataType: 'json',
					  success: function(data){
					  	//console.log(data);
					    if(data.status.code)
					    {
					    	window.location.reload();
					    }
					  }
					});
			       
			     });
			   } else {
			     
			   }
			 }, {scope: 'email'});
			return false;
		});
		
	});
</script>