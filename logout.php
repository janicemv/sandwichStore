<?php
// logout.php

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;

SessionService::logout();

header("Location: index.php");
exit;
