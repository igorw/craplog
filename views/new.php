<?php $this->layout('layout') ?>

<?php $this->block('body') ?>
    <h1>Create new post</h1>

    <form method="POST" action="new.php">
        <ul>
            <li><label>
                Id: <input name="id">
            </label></li>
            <li><label>
                Title: <input name="title">
            </label></li>
            <li><label>
                Body: <textarea name="body"></textarea>
            </label></li>
            <li>
                <input type="hidden" name="csrfToken" value="<?= $this->escape($csrfToken) ?>">
                <input type="submit">
            </li>
        </ul>
    </form>
<?php $this->end() ?>
