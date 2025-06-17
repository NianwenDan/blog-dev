<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()) : ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>

        <?php $comments->listComments(); ?>

        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <?php endif; ?>

    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>

            <h3 class="is-size-4" id="response"><?php _e('添加新评论'); ?></h3>

            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <?php if ($this->user->hasLogin()) : ?>
                    <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
                    </p>
                <?php else : ?>
                    <div class="field">
                        <label for="author" class="label"><?php _e('称呼'); ?></label>
                        <div class="control">
                            <input type="text" name="author" id="author" class="input" placeholder="James" value="<?php $this->remember('author'); ?>" required />
                        </div>
                        <p class="help is-danger">*<?php _e('称呼'); ?>是必填项</p>
                    </div>

                    <div class="field">
                        <label for="mail" class="label"><?php _e('Email'); ?></label>
                        <div class="control">
                            <input type="email" name="mail" id="mail" class="input" placeholder="email@example.com" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail) : ?> required<?php endif; ?> />
                        </div>
                        <?php if ($this->options->commentsRequireMail): ?>
                        <p class="help is-danger">*<?php _e('Email'); ?>是必填项</p>
                        <?php endif; ?>
                    </div>

                    <div class="field">
                        <label for="url" class="label"><?php _e('网站'); ?></label>
                        <div class="control">
                            <input type="url" name="url" id="url" class="input" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> />
                        </div>
                        <?php if ($this->options->commentsRequireURL): ?>
                        <p class="help is-danger">*<?php _e('网站'); ?>是必填项</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="field">
                    <label for="textarea" class="label"><?php _e('内容'); ?></label>
                    <div class="control">
                        <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required><?php $this->remember('text'); ?></textarea>
                    </div>
                    <p class="help is-danger">*<?php _e('内容'); ?>是必填项</p>
                </div>
                <div class="field">
                    <button type="submit" class="button"><?php _e('提交评论'); ?></button>
                </div>
            </form>

        </div>
    <?php else : ?>
        <h3 class="respond-closed"><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>