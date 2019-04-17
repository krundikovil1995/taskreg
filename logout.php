<?php
session_start();
unset($_SESSION['username']);

setcookie('username', '', time() - 3600);
setcookie('password', '', time() - 3600);

header('Location: http://localhost:8080/test/testreg/');
session_destroy()

?>