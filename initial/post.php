<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
if (!empty($this->options->Breadcrumbs) && in_array('Postshow', $this->options->Breadcrumbs)): ?>
<div class="breadcrumbs">
<a href="<?php $this->options->siteUrl(); ?>">Home</a> &raquo; <?php $this->category(); ?> &raquo; <?php echo !empty($this->options->Breadcrumbs) && in_array('Text', $this->options->Breadcrumbs) ? 'Main' : $this->title; ?>
</div>
<?php endif; ?>
<article class="post<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>">
<h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
<ul class="post-meta">
<li><p>Posted <?php $this->date(); ?></p></li>
<li><?php $this->category(','); ?></li>
<li><?php Postviews($this); ?></li>
<?php date_default_timezone_set('MST');
if (date('Ymd', $this->created) != date('Ymd', $this->modified)): ?>
<li><p>Last Updated <?php echo date('M. d, Y' , $this->modified); ?></p></li>
<?php endif; ?>
</ul>
<div class="post-content">
<?php $this->content(); ?>
</div>
<?php if ($this->options->WeChat || $this->options->Alipay): ?>
<p class="rewards">Donate: <?php if ($this->options->WeChat): ?>
<a><img src="<?php $this->options->WeChat(); ?>" alt="WeChat QR Code" />WeChat</a><?php endif; if ($this->options->WeChat && $this->options->Alipay): ?>, <?php endif; if ($this->options->Alipay): ?>
<a><img src="<?php $this->options->Alipay(); ?>" alt="Alipay QR Code" />Alipay</a><?php endif; ?>
</p>
<?php endif; ?>
<p class="tags">Tags: <?php $this->tags(', ', true, 'No tags yet'); ?></p>
<?php if ($this->options->LicenseInfo !== '0'): ?>
<p class="license"><?php echo $this->options->LicenseInfo ? $this->options->LicenseInfo : 'This post is followed under the <a href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank" rel="license nofollow">Attribution-ShareAlike 4.0 International</a>' ?></p>
<?php endif; ?>
</article>
<?php $this->need('comments.php'); ?>
<ul class="post-near">
<li>Previous Post: <?php $this->thePrev('%s','You are in the earliest post!'); ?></li>
<li>Next Post: <?php $this->theNext('%s','You are in the latest post!'); ?></li>
</ul>
</div>
<?php if (!$this->options->OneCOL): $this->need('sidebar.php'); endif; ?>
<?php $this->need('footer.php'); ?>