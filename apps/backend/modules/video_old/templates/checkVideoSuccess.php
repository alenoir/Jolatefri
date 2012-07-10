<div id="backend-video">
<?php 
foreach($videos as $video):

	include_partial('preview', array('video'=> $video, 'categories' => $categories));

endforeach;
?>
</div>
<script type="text/javascript">

$(document).ready(function(){
	$('.valide').click(function(){
		
		var id = $(this).attr('id');
		var element = $(this);
		$.ajax({
			url: '/backend.php/video/activate',
			data: "vid="+id,
			type: 'post',
			success: function(data){
				element.closest('article').fadeOut('500');
			}
		});
		return false;
	});
	
	$('.delete').click(function(){
		
		var id = $(this).attr('id');
		var element = $(this);
		$.ajax({
			url: '/backend.php/video/delete',
			data: "vid="+id,
			type: 'post',
			success: function(data){
				$('#'+id).html(data);
				element.closest('article').fadeOut('500');
			}
		});
		return false;
	});
	
	$('form .title, form .description, form .category_id').focusout(function(){
		
		var data = $(this).closest('form').serialize();
		$.ajax({
			url: '/backend.php/video/ajaxEdit',
			data: data,
			type: 'post',
			success: function(data){
				
			}
		});
		return false;
	});
});
</script>