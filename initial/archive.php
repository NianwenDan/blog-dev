<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>
<div class="breadcrumbs"><a href="<?php $this->options->siteUrl(); ?>">Home</a> &raquo; <?php $this->archiveTitle(array(
'category'  =>  _t('Posts under category %s'),
'search'    =>  _t('Results for %s'),
'tag'       =>  _t('Posts tagged with %s'),
'date'      =>  _t('%s published posts'),
'author'    =>  _t('Author %s published posts')
), '', ''); ?></div>
<?php if ($this->have()): ?>
<?php while($this->next()): ?>
<article class="post<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>">
<h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
<ul class="post-meta">
<li><?php $this->date(); ?></li>
<li><?php $this->category(',', false); ?></li>

<li><?php Postviews($this); ?></li>
</ul>
<div class="post-content">
<?php if ($this->options->PjaxOption && $this->hidden): ?>
<form <?php if (!$this->options->AjaxLoad): ?>action="<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>" <?php endif; ?>method="post">
<p class="word">Please enter the password to access:</p>
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
<?php else: ?>
<article class="post">
<h2 class="post-title">Nothing found</h2>
</article>
<?php endif; ?>
<?php $this->pageNav('Previous Page', $this->options->AjaxLoad ? 'Read More' : 'Next Page', 0, '..', $this->options->AjaxLoad ? array('wrapClass' => 'page-navigator ajaxload') : ''); ?>
</div>
<?php if (!$this->options->OneCOL): $this->need('sidebar.php'); endif; ?>
<?php $this->need('footer.php'); ?>