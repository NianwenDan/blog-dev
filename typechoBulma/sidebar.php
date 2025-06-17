<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)) : ?>
    <section class="widget">
        <h3 class="widget-title is-size-5"><?php _e('最新文章'); ?></h3>
        <ul class="widget-list">
            <?php \Widget\Contents\Post\Recent::alloc()
                ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)) : ?>
    <section class="widget">
        <h3 class="widget-title is-size-5"><?php _e('最近回复'); ?></h3>
        <ul class="widget-list">
            <?php \Widget\Comments\Recent::alloc()->to($comments); ?>
            <?php while ($comments->next()) : ?>
                <li>
                    <a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)) : ?>
    <section class="widget">
        <h3 class="widget-title is-size-5"><?php _e('分类'); ?></h3>
        <?php \Widget\Metas\Category\Rows::alloc()->listCategories('wrapClass=widget-list'); ?>
    </section>
<?php endif; ?>

<?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)) : ?>
    <section class="widget">
        <h3 class="widget-title is-size-5"><?php _e('归档'); ?></h3>
        <ul class="widget-list">
            <?php \Widget\Contents\Post\Date::alloc('type=month&format=F Y')
                ->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (!empty($this->options->sidebarBlock) && in_array('ShowTag', $this->options->sidebarBlock)) : ?>
    <section class="widget">
        <h3 class="widget-title is-size-5">标签</h3>
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

<?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)) : ?>
    <section class="widget">
        <h3 class="widget-title is-size-4"><?php _e('其它'); ?></h3>
        <ul class="widget-list">
            <?php if ($this->user->hasLogin()) : ?>
                <li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?>
                        (<?php $this->user->screenName(); ?>)</a></li>
                <li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
            <?php else : ?>
                <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a>
                </li>
            <?php endif; ?>
            <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
            <li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
            <li><a href="http://www.typecho.org">Typecho</a></li>
        </ul>
    </section>
<?php endif; ?>