<?php

require __DIR__.'/bootstrap.php';

setcookie(session_name(), '', 0);
header('Location: index.php');
