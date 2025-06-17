<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options) {
	$commentClass = '';
	if ($comments->authorId) {
		if ($comments->authorId == $comments->ownerId) {
			$commentClass .= ' comment-by-author';
		} else {
			$commentClass .= ' comment-by-user';
		}
	}
?>
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
	if ($comments->levels > 0) {
		echo ' comment-child';
		$comments->levelsAlt(' comment-level-odd', ' comment-level-even');
	} else {
		echo ' comment-parent';
	}
	$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
<div id="<?php $comments->theId(); ?>">
<div class="comment-author">
<?php $comments->gravatar('32'); ?>
<b><?php CommentAuthor($comments); ?></b>
<?php if ($comments->authorId == $comments->ownerId) { ?>
<span class="author-icon">Author</span>
<?php } ?>
<?php if ($comments->status == 'waiting') { ?>
<em>Your comment is awaiting approval!</em>
<?php } ?>
</div>
<div class="comment-meta">
<time><?php $comments->date(); ?></time>
</div>
<div class="comment-content">
<?php $comments->content(); ?>
</div>
<div class="comment-reply">
<?php $comments->reply(); ?>
</div>
</div>
<?php if ($comments->children) { ?>
<div class="comment-children">
<?php $comments->threadedComments($options); ?>
</div>
<?php } ?>
</li>
<?php } ?>
<div id="comments">
<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()): ?>
<h3><?php $this->commentsNum(_t('No comments yet'), _t('<span class="comment-num">%d</span> comments')); ?></h3>
<?php $comments->listComments(); ?>
<?php $comments->pageNav('Previous Page', 'Next Page', 0, '..'); ?>
<?php endif; ?>
<?php if($this->allow('comment')): ?>
<div id="<?php $this->respondId(); ?>" class="respond">
<div class="cancel-comment-reply">
<?php $comments->cancelReply(); ?>
</div>
<h3 id="response">New Comment</h3>
<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form"<?php if(!$this->user->hasLogin()): ?> class="comment-form clearfix"<?php endif; ?>>
<?php if($this->user->hasLogin()): ?>
<p>Logged in as: <a href="<?php $this->options->profileUrl(); ?>" target="_blank"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"<?php if ($this->options->PjaxOption): ?> no-pjax<?php endif; ?>>Quit &raquo;</a></p>
<?php endif; ?>
<p <?php if(!$this->user->hasLogin()): ?>class="textarea"<?php endif; ?>>
<textarea name="text" id="textarea" placeholder="Join this Discussion..." required ><?php $this->remember('text'); ?></textarea>
</p>
<p <?php if(!$this->user->hasLogin()): ?>class="textbutton"<?php endif; ?>>
<?php if(!$this->user->hasLogin()): ?>
<input type="text" name="author" id="author" class="text" placeholder="Name *" value="<?php $this->remember('author'); ?>" required />
<input type="email" name="mail" id="mail" class="text" placeholder="E-mail<?php if ($this->options->commentsRequireMail): ?> *<?php endif; ?>" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
<input type="url" name="url" id="url" class="text" placeholder="http://<?php if ($this->options->commentsRequireURL): ?> *<?php endif; ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
<div style="display: inline-block;"><?php MeHttpPush_Plugin::auth(); ?></div>
<?php endif; ?>
<!-- “Only Show Submit button when loginned” -->
<?php if($this->user->hasLogin()): ?>
<button type="submit" class="submit">Submit Comment</button>
<?php endif; ?>
</p>
</form>
</div>
<?php if ($this->options->commentsThreaded): ?>
<script>(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom('<?php $this->respondId(); ?>'),input=this.dom('comment-parent'),form='form'==response.tagName?response:response.getElementsByTagName('form')[0],textarea=response.getElementsByTagName('textarea')[0];if(null==input){input=this.create('input',{'type':'hidden','name':'parent','id':'comment-parent'});form.appendChild(input)}input.setAttribute('value',coid);if(null==this.dom('comment-form-place-holder')){var holder=this.create('div',{'id':'comment-form-place-holder'});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.dom('cancel-comment-reply-link').style.display='';if(null!=textarea&&'text'==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom('<?php $this->respondId(); ?>'),holder=this.dom('comment-form-place-holder'),input=this.dom('comment-parent');if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.dom('cancel-comment-reply-link').style.display='none';holder.parentNode.insertBefore(response,holder);return false}}})();</script>
<?php endif; ?>
<?php else: ?>
<!-- “评论区关闭提示字” -->
<center>
<h5>Comments are turned off. <a href="https://en.nwdan.com/why-comments-are-turned-off" target="_blank">Learn More</a></h5>
</center>
<?php endif; ?>
</div>
