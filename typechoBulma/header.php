<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<?php if ($this->options->lang == 'zh_CN'): ?>
    <html lang="zh-Hans" dir="ltr" prefix="og: http://ogp.me">
<?php else: ?>
    <html lang="en" dir="ltr" prefix="og: http://ogp.me">
<?php endif; ?>

<head>
    <!-- start website metadata (seo)-->
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $this->archiveTitle([
                'category' => _t('分类 %s 下的文章'),
                'search'   => _t('包含关键字 %s 的文章'),
                'tag'      => _t('标签 %s 下的文章'),
                'author'   => _t('%s 发布的文章')
            ], '', ' - '); ?><?php $this->options->title(); ?>
    </title>
    <meta name="description" content="<?php echo $this->getDescription(); ?>" >
    <meta name="keywords" content="<?php $this->is('single') ? $this->tags(', ', false, '') : $this->keywords(); ?>" >
    <meta property="og:site_name" content="<?php $this->options->title(); ?>">
    <meta property="og:type" content="<?= $this->is('single') ? 'article' : 'website' ?>">
    <meta property="og:title" content="<?php $this->archiveTitle([
                'category' => _t('分类 %s 下的文章'),
                'search'   => _t('包含关键字 %s 的文章'),
                'tag'      => _t('标签 %s 下的文章'),
                'author'   => _t('%s 发布的文章')
            ], ''); ?>">
    <meta property="og:url" content="<?php $this->is('single') ? $this->permalink() : $this->options->siteUrl(); ?>">
    <meta property="og:description" content="<?php echo $this->getDescription(); ?>">
    <meta property="og:image" content="<?php $this->options->themeUrl('img/default-og-banner.jpg'); ?>">
    <meta property="og:locale" content="zh_CN">
    <!-- end website metadata (seo)-->

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/normalize.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/bulma.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.font.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/atom-one-highlightjs.min.css'); ?>">
    <link rel="shortcut icon" href="<?php $this->options->themeUrl('img/avatar.png'); ?>">
    <!-- 通过自有函数输出HTML头部信息 -->

    <!-- Katex -->
    <?php if ($this->is('post') && $this->fields->isLatex == 1) : ?>
        <?php if ($this->options->lang == 'zh_CN'): ?>
            <script defer type="text/javascript" src="https://cdn.staticfile.net/KaTeX/0.16.9/katex.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.net/KaTeX/0.16.9/katex.min.css" />
            <script defer type="text/javascript" src="https://cdn.staticfile.net/KaTeX/0.16.9/contrib/auto-render.min.js"></script>
        <?php else: ?>
            <script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
            <script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>
        <?php endif; ?>
    <?php endif; ?>
    <!-- Katex -->
    <script defer src="<?php $this->options->siteUrl(); ?>ympbsfvdHEfUa6bAJMVa" data-website-id="fc1ec02c-1ee3-49a4-8452-b8d1576fd77c"></script>
    <?php // Do Not Output Default meta tag as shown below, but enabled is required if you use plugin to insert css and js ?>
    <?php $this->header('description=&keywords=&generator=&template=&pingback=&xmlrpc=&wlw='); ?>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="<?php $this->options->siteUrl(); ?>">
                    <img src="<?php $this->options->themeUrl('img/avatar.png'); ?>" alt="闻者通达">
                    <span class="title is-size-5"><?php $this->options->title() ?></span>
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navMenu" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="<?php $this->options->siteUrl(); ?>">
                        <?php _e('首页'); ?>
                    </a>
                    <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
                    <?php while ($pages->next()) : ?>
                        <a class="navbar-item" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>">
                            <?php $pages->title(); ?>
                        </a>
                    <?php endwhile; ?>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <form class="field has-addons" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                            <div class="control is-expanded">
                                <input class="input" type="text" id="s" name="s" placeholder="<?php _e('输入关键字搜索'); ?>" required />
                            </div>
                            <div class="control">
                                <button class="button" type="submit" data-umami-event="Header Search Button"><?php _e('搜索'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>