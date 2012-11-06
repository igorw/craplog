<?php $this->layout('layout') ?>

<?php $this->block('body') ?>
    <form method="POST" action="edit.php?id=<?= urlencode($post['id']) ?>">
        <ul>
            <li><label>
                Title: <input name="title" value="<?= $this->escape($post['title']) ?>">
            </label></li>
            <li><label>
                Body: <textarea name="body"><?= $this->escape($post['body']) ?></textarea>
            </label></li>
            <li>
                <input type="hidden" name="csrfToken" value="<?= $this->escape($csrfToken) ?>">
                <input type="submit">
            </li>
        </ul>
    </form>
<?php $this->end() ?>
