<section id="content" class="new-video form">
	<h2 class="title">Proposer une vidéo</h2>
<!--div id="search-youtbe">
	<form id="search-youtbe-form" action="" method="post">
		<input type="text" name="query" value="Rechercher une vidéo" />
	</form>
	<div id="result-youtube"></div>
</div-->
<?php include_partial('newVideoForm', array('form' => $form)) ?>
</section>

<script>
$(document).ready(function(){
	$('#search-youtbe-form').submit(function(){
	
		var query = $(this).serialize();
		console.log(query);
		$.ajax({
			url: '/video/searchYoutube',
			data: "query="+query,
			type: 'post',
			success: function(data){
				$('#result-youtube').html(data);
			}
		});
		return false;
	});
});
</script>