<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="container wrapper">
    <div class="columns is-gapless">
        <div class="column is-two-thirds">
            <main class="section">
                <div class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
                        <li><a href="">页面 <?php $this->title() ?></a></li>
                    </ul>
                </div>
                <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
                    <h1 class="post-title title" itemprop="name headline">
                        <a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                    </h1>
                    <div class="post-content content" itemprop="articleBody">
                        <?php $this->content(); ?>
                    </div>
                </article>
                <?php $this->need('comments.php'); ?>
            </main>
        </div>
        <div class="column sidebar">
            <?php $this->need('sidebar.php'); ?>
        </div>
    </div>
</div>

<?php $this->need('footer.php'); ?>