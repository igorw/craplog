<?php $this->layout('layout') ?>

<?php $this->block('body') ?>
    <?php if ($user && $authorizer->hasRole($user, 'admin')): ?>
    <p>
        <a href="edit.php?id=<?= urlencode($post['id']) ?>">Edit</a>
        <form method="POST" action="delete.php?id=<?= urlencode($post['id']) ?>">
            <input type="hidden" name="csrfToken" value="<?= $this->escape($csrfToken) ?>">
            <input type="submit" value="Delete">
        </form>
    </p>
    <?php endif ?>

    <h1><?= $this->escape($post['title']) ?></h1>

    <p>
        <?= $post['body'] ?>
    </p>
<?php $this->end() ?>
