<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="container wrapper">
    <div class="columns is-gapless">
        <div class="column is-two-thirds">
            <main class="section">
                <div class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
                        <li><?php $this->category('&amp;'); ?></li>
                        <li><a href="<?php $this->permalink() ?>">.</a></li>
                    </ul>
                </div>

                <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
                    <h1 class="post-title title" itemprop="name headline">
                        <a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                    </h1>
                    <ul class="post-meta">
                        <li>发布:
                            <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                        </li>
                        <?php if (date('Ymd', $this->created) != date('Ymd', $this->modified)): ?>
                            <li>更新:
                                <time datetime="<?php echo date('Y-m-d', $this->modified); ?>" itemprop="datePublished"><?php echo date('Y-m-d', $this->modified); ?></time>
                            </li>
                        <?php endif; ?>
                        <li>
                            <?php postViews($this); ?>
                        </li>
                    </ul>
                    <?php if (count($this->tags) != 0): ?>
                        <div itemprop="keywords" class="post-meta tags">标签: <span class="tag"><?php $this->tags('</span><span class="tag">', true, 'none'); ?></span></div>
                    <?php endif; ?>
                    <?php
                    $datetime_start = new DateTime();
                    $datetime_end = new DateTime(date($this->options->postDateFormat, $this->modified));
                    $month = intval(($datetime_start->diff($datetime_end)->days) / 30);
                    if ($month >= 6) { ?>
                        <div class="message is-warning">
                            <div class="message-header">
                                <p>提示</p>
                            </div>
                            <div class="message-body">
                                本文由于上次更新日期较早, 可能存在过时信息。
                            </div>
                        </div>
                    <?php } ?>
                    <div class="post-content content" itemprop="articleBody">
                        <?php $this->content(); ?>
                    </div>
                </article>
                <?php $this->need('comments.php'); ?>
                <ul class="post-near">
                    <li>上一篇: <?php $this->thePrev('%s', '没有了'); ?></li>
                    <li>下一篇: <?php $this->theNext('%s', '没有了'); ?></li>
                </ul>
            </main>
        </div>
        <div class="column sidebar">
            <?php $this->need('sidebar.php'); ?>
        </div>
    </div>
</div>

<?php $this->need('footer.php'); ?>