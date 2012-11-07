<?php $this->layout('layout') ?>

<?php $this->block('body') ?>
    <h1>Whoops!</h1>

    <p><?= $this->escape($error) ?></p>
<?php $this->end() ?>
