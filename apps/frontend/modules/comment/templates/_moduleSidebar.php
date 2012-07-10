<div id="module-comment" class="comment">
	<h3>
		Les derniers commentaires
	</h3>
	<ul>
		<?php foreach($comments as $comment):?>
		<li>
			<span class="name"><?php echo $comment->getUsername();?> : </span>
			<span class="message"><?php echo $comment->getExcerpt(40);?></span><br />
			<a href="<?php echo $comment->getVideo()->getUrlShow();?>" title="<?php echo $comment->getVideo()->getTitle();?>" class="link"><?php echo $comment->getVideo()->getTitle();?></a>
		</li>
		<?php endforeach;?>
	</ul>
</div>
