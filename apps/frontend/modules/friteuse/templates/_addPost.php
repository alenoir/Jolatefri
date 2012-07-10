<div id="wrapper-add-post">
	<a id="btn-add-post" href="#" title="Ajouter un post à la friteuse">
		Ajoute ton post à la friteuse
	</a>
	<div id="wrapper-form-friteuse">
		<?php if ($sf_user->isAuthenticated()):?>
			<div id="choice-form-friteuse">
				<a class="image" href="#">Image</a>
				<a class="video" hef="#">Vidéo</a>
				<div class="clear"></div>
			</div>
			<img style="display:none;" class="loader" src="/images/loader.gif" />
			<form class="form-add-post form-large" id="image-form" action="<?php echo url_for('@ajax_friteuse_add?type=image');?>" enctype="multipart/form-data" method="post">

				<?php echo $formImage->renderHiddenFields(false) ?>

				<?php echo $formImage->renderGlobalErrors() ?>
				<?php echo $formImage['title']->renderLabel() ?><br />
				<?php echo $formImage['title']->renderError() ?>
				<?php echo $formImage['title'] ?>
				<?php echo $formImage['image']->renderLabel() ?> <span class="help">(jpeg, png, gif)</span><br />
				<?php echo $formImage['image']->renderError() ?>
				<?php echo $formImage['image'] ?>
				<br />
				<input type="submit" value="Publier l'image" />

			</form>
			
			<form class="form-add-post form-large" id="video-form" action="<?php echo url_for('@ajax_friteuse_add?type=video');?>" method="post">
				
				<?php echo $formVideo->renderHiddenFields(false) ?>
				  
				        
				<?php echo $formVideo->renderGlobalErrors() ?>
				<?php echo $formVideo['title']->renderLabel() ?><br />
				      
				<?php echo $formVideo['title']->renderError() ?>
				<?php echo $formVideo['title'] ?>
				<?php echo $formVideo['code']->renderLabel() ?> <span class="help">(Vidéo de Youtube uniquement)</span><br />
		        <?php echo $formVideo['code']->renderError() ?>
		        <?php echo $formVideo['code'] ?>
		        
		        
		        <br />
				<input type="submit" value="Publier la vidéo" />
			</form>
			
			<div id="error-form-friteuse" class="error">
				
			</div>
		<?php else:?>
			
			<?php include_component('user','socialConnect');?>

		<?php endif;?>
		
	</div>
	<div class="clear"></div>	
</div>

<script>
	$(document).ready(function(){
		$('#btn-add-post').click(function(){
			if($('#wrapper-form-friteuse').data('show'))
			{
				clear_form_elements('.form-add-post');
				
				
			}
			else
			{
				$('#wrapper-form-friteuse').fadeIn(function(){
					$('#wrapper-form-friteuse').data('show', 1)
				});
			}
			return false;
		});
		
		$('#choice-form-friteuse a').click(function(){
			$('.form-add-post').hide();
			$('#choice-form-friteuse').hide();
			
			var attr = $(this).attr('class');
			$('#'+attr+'-form').show();
		});
		
		$('#video-form').submit(function(){
			$('.form-add-post input').removeClass('error');
			
			var id = $(this).attr('id');

				if($('#friteuseVideo_title').val() == '')
				{
					$('#friteuseVideo_title').addClass('error');
				}
				if($('#friteuseVideo_code').val() == '')
				{
					$('#friteuseVideo_code').addClass('error');
				}
				
				
				var urlAjax = "<?php echo url_for('@ajax_friteuse_add?type=video');?>";
				
				var dataForm = $(this).serialize();
				
				$.ajax({
				  url: urlAjax,
				  data: dataForm,
				  dataType:'json',
				  type:'post',
				  success: function(response){
				    	if(response.error)
				    	{
				    		$('#error-form-friteuse').html(response.error.html);
				    		
				    	}
				    	else
				    	{
				    		$('#list-post-friteuse').prepend('<li class="entry">'+response.data.html+'</li>').hide().fadeIn();
				    		clear_form_elements('.form-add-post');
				    		$.sticky(response.data.response);
				    	}
				  }
				});
				
				return false;
		});
		$('#image-form').submit(function(){
			$('.form-add-post input').removeClass('error');
			
			var id = $(this).attr('id');
			
			var error=false;
			if($('#friteuseImage_title').val() == '')
			{
				$('#friteuseImage_title').addClass('error');
				error=true;
			}
			
			if($('#friteuseImage_image').val() == '')
			{
				$('#friteuseImage_image').addClass('error');
				error=true;
			}
			
			if(error)
			{
				return false;
			}
			else
			{
				$('.form-add-post').hide();
				$('.loader').show();
			}

			
			
			
		});
	});
	
	function clear_form_elements(ele) {

    	$(ele).find(':input').each(function() {
	        switch(this.type) {
	            case 'password':
	            case 'select-multiple':
	            case 'select-one':
	            case 'text':
	            case 'textarea':
	                $(this).val('');
	                break;
	            case 'checkbox':
	            case 'radio':
	                this.checked = false;
	        }
	        
	        
	    });
		$('#wrapper-form-friteuse').fadeOut(function(){
			$('#wrapper-form-friteuse').data('show', 0)
			$('.form-add-post').hide();
			$('#choice-form-friteuse').show();
		});
		
		$('#error-form-friteuse').html('');
			
		$('.form-add-post input').removeClass('error');
	}
</script>