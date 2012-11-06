<!DOCTYPE html>
<html>
<head>
    <title>Craplog</title>
</head>
<body>

<?= $this->getBlock('body') ?>

<?php if ($user): ?>
<p>
    <a href="logout.php">Logout</a>
</p>
<?php else: ?>
<p>
    <a href="login.php">Login</a>
</p>
<?php endif ?>

</body>
</html>