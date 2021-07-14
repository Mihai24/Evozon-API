<?php

$token = bin2hex(random_bytes(16));

\setcookie('token', $token);

echo 'English-Elvish dictionary';