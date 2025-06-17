<?php
/**
 * Initial - 简约而不简单
 * 还原本质 勿忘初心
 * 
 * @package Initial
 * @author JIElive
 * @version 2.5.4
 * @link http://www.offodd.com/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
if ($this->_currentPage == 1 && !empty($this->options->ShowWhisper) && in_array('index', $this->options->ShowWhisper)): ?>
<article class="post whisper">
<?php Whisper(); ?>
</article>
<?php endif; ?>
<?php while($this->next()): ?>
<?php /* Skip output posts with password */ if ($this->hidden) { continue; } ?>
<article class="post<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>">
<h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
<ul class="post-meta">
<li><p>Posted on <?php $this->date(); ?></p></li>
<li><?php $this->category(',', false); ?></li>
<li><?php $this->commentsNum('No Comments', '%d Comments'); ?></li>
</ul>
<div class="post-content">
<?php if ($this->options->PjaxOption && $this->hidden): ?>
<form <?php if (!$this->options->AjaxLoad): ?>action="<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>" <?php endif; ?>method="post">
<p class="word">Please enter the passcode!</p>
<p>
<input type="password" class="text" name="protectPassword" />
<input type="submit" class="submit" value="Submit" />
</p>
</form>
<?php else: ?>
<?php if (postThumb($this)): ?>
<p class="thumb"><?php echo postThumb($this); ?></p>
<?php endif; ?>
<p><?php $this->excerpt(200, ''); ?></p>
<?php endif; if (!$this->options->OneCOL): ?>
<p class="more"><a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">Read More ></a></p>
<?php endif; ?>
</div>
</article>
<?php endwhile; ?>
<?php $this->pageNav(); ?>
</div>
<?php if (!$this->options->OneCOL): $this->need('sidebar.php'); endif; ?>
<?php $this->need('footer.php'); ?>