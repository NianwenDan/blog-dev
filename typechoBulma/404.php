<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="container is-max-desktop wrapper">

    <main class="error-page">
        <h2 class="title">404 - <?php _e('页面没找到'); ?></h2>
        <p>你想查看的页面已被转移或删除了</p>
        <div class="error-page-recommand">
            <div class="columns">
                <div class="column">
                    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)) : ?>
                        <section class="widget">
                            <h3 class="widget-title is-size-4"><?php _e('最新文章'); ?></h3>
                            <ul class="widget-list">
                                <?php \Widget\Contents\Post\Recent::alloc()
                                    ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
                            </ul>
                        </section>
                    <?php endif; ?>
                </div>
                <div class="column">
                    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowTag', $this->options->sidebarBlock)) : ?>
                        <section class="widget">
                            <h3 class="widget-title is-size-4">标签</h3>
                            <div class="widget-list tags">
                                <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
                                <?php if ($tags->have()) : ?>
                                    <?php while ($tags->next()) : ?>
                                        <span class="tag"><a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a></span>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <li>No tags yet</li>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>


</div><!-- end #content-->
<?php $this->need('footer.php'); ?>