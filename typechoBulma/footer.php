<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer class="footer" role="contentinfo">
    <div class="content has-text-centered">
        <p>
            &copy; 2021 - <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
            <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.
        </p>
        <p>
            <a href="http://beian.miit.gov.cn" class="icpnum" target="_blank" rel="noreferrer">鄂ICP备2022004521号</a>
            <span>
                <img src="<?php $this->options->themeUrl('img/gongan.png'); ?>" alt="gongan_beian" id="gongan_beian">
            </span>
            <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=42010702000656" class="icpnum" target="_blank" rel="noreferrer">鄂公网安备 42010702000656号</a>
        </p>
        <p>
            <a href="<?php $this->options->siteUrl(); ?>sitemap.xml" target="_blank">Sitemap</a> | 
            <a href="https://en.nwdan.com/" target="_blank">English</a>
        </p>
    </div>
</footer>

<?php $this->footer(); ?>
<script src="<?php $this->options->themeUrl('js/highlight.min.js'); ?>"></script>
<?php if ($this->is('post') && $this->fields->isLatex == 1) : ?>
    <script src="<?php $this->options->themeUrl('js/katex-config.js'); ?>"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('js/app.js'); ?>"></script>
</body>

</html>