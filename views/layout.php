<!DOCTYPE html>
<html>
<head>
    <title>Painblog</title>
</head>
<body>

<?= $this->getBlock('body') ?>

<?php if (!$user): ?>
<p>
    <a href="login.php">Login</a>
</p>
<?php endif ?>

</body>
</html>