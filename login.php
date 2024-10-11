<?php
//login.php /

declare(strict_types=1);

$error = $_GET['error'] ?? '';

include("presentation/loginForm.php");
