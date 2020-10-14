#!/usr/bin/env php
<?php

declare(strict_types=1);
error_reporting(E_ALL);

$autoload = implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);
require_once $autoload;
