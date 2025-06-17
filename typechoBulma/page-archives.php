<?php

/**
 * 归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<article class="container is-max-desktop wrapper">
    <?php
    $this->widget('Widget_Contents_Post_Recent', 'pageSize=' . Typecho_Widget::widget('Widget_Stat')->publishedPostsNum)->to($archives);
    $year = 0;
    $output = '<div class="content" id="archives">';
    while ($archives->next()) {
        $year_tmp = date('Y', $archives->created);
        if ($year > $year_tmp) {
            $output .= '</ul>';
        }
        if ($year != $year_tmp) {
            $year = $year_tmp;
            $output .= '<h3>' . date('Y', $archives->created) . '</h3><ul>';
        }
        $output .= '<li><span class="archive-list-date has-text-grey">' . date('m/d', $archives->created) . '</span>' . '<a href="' . $archives->permalink . '">' . $archives->title . '</a></li>';
    }
    $output .= '</ul></div>';
    echo $output;
    ?>
</article>
</div>

<?php $this->need('footer.php'); ?>