<?php

require __DIR__.'/bootstrap.php';

$session->destroy();
header('Location: index.php');
