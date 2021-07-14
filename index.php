<?php

$token = bin2hex(random_bytes(16));

\session_start();

echo 'English-Elvish dictionary';