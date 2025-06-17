<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>



<div class="container wrapper">
    <div class="columns is-gapless">
        <div class="column is-two-thirds">
            <main class="section">
                <div class="container">
                    <div class="breadcrumb" aria-label="breadcrumbs">
                        <ul>
                            <li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
                            <li>
                                <a href="">
                                    <?php $this->archiveTitle([
                                        'category' => _t('分类 %s 下的文章'),
                                        'search'   => _t('包含关键字 %s 的文章'),
                                        'tag'      => _t('标签 %s 下的文章'),
                                        'author'   => _t('%s 发布的文章')
                                    ], '', ''); ?>
                            </li>
                            </a>
                        </ul>
                    </div>
                    <?php if ($this->have()) : ?>
                        <?php while ($this->next()) : ?>
                            <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
                                <h2 class="post-title is-size-5" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                                </h2>
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
                                <?php if (postThumbLink($this)) : ?>
                                    <div class="post-thumb">
                                        <img src="<?php echo postThumbLink($this); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="post-content" itemprop="articleBody">
                                    <p><?php $this->excerpt(200, ''); ?></p>
                                </div>
                                <div class="post-read-more-button">
                                    <a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>" class="button">阅读更多</a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <article class="post">
                            <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
                        </article>
                    <?php endif; ?>
                    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                        <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
                    </nav>
            </main>
        </div>
        <div class="column sidebar">
            <?php $this->need('sidebar.php'); ?>
        </div>
    </div>

</div>
</div>

<?php $this->need('footer.php'); ?>