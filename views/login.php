<?php $this->layout('layout') ?>

<?php $this->block('body') ?>
    <h1>Login</h1>

    <?php if ($name): ?>
        <p class="error">
            You must have accidentally your password, try again.
        </p>
    <?php endif ?>

    <form method="POST" action="login.php">
        <ul>
            <li><label>Name: <input name="name" value="<?= $this->escape($name) ?>"></label></li>
            <li><label>Password: <input name="password" type="password"></label></li>
            <li><input type="submit"></li>
        </ul>
    </form>
<?php $this->end() ?>
