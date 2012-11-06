<!DOCTYPE html>
<html>
<head>
    <title>Craplog</title>
</head>
<body>

<?= $this->getBlock('body') ?>

<nav>
    <ul>
        <li><a href="index.php">Index</a></li>
        <?php if ($user && $authorizer->hasRole($user, 'admin')): ?>
            <li><a href="new.php">New post</a></li>
        <?php endif ?>
        <?php if ($user): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif ?>
    </ul>
</nav>

</body>
</html>
