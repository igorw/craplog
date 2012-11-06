<?php $this->layout('layout') ?>

<?php $this->block('body') ?>
    <h1>Painblog</h1>

    <ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <?= date('M d', strtotime($post['date'])) ?>
            <a href="post.php?id=<?= urlencode($post['id']) ?>">
                <?= $this->escape($post['title']) ?>
            </a>
        </li>
    <?php endforeach ?>
    </ul>
<?php $this->end() ?>
