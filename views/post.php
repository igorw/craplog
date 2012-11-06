<?php $this->layout('layout') ?>

<?php $this->block('body') ?>
    <h1><?= $this->escape($post['title']) ?></h1>

    <p>
        <?= $post['body'] ?>
    </p>
<?php $this->end() ?>
