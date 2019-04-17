<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>example</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>


<h1>Welcome to my site!</h1>
<div id="result"></div>

<?php session_start(); if (isset($_SESSION['username'])): ?>

    <h2>Hi, <?php echo $_SESSION['username']; ?></h2>
    <form class="log" action="logout.php" method="post">
        <input class="but" type="submit" value="logout">
    </form>


<?php  else: ?>


<form id="signin" class="signin" method="post" action="signin.php">
    <fieldset>
        <legend>Sign In</legend>
    <label for="signin_login">Login: </label>
    <input type="text" id="signin_login" name="username" value="<?php if (isset($_COOKIE['username'])){echo $_COOKIE['username'];} ?>" placeholder="login"></br>
    <label for="signin_pass">Password: </label>
    <input type="password" id="signin_pass" name="pass" value="<?php if (isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>" placeholder="Password"></br>
        <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE['username'])){ ?>checked<?php } ?> value="remember"><b class="remember">Remember me</b></br>
    <input class="but" type="submit" name="submit" value="Sign In">
        <button type="submit" id="signin_reg" formaction="#">Sign Up</button>
    </fieldset>
</form>

<form id="signup" class="signup" method="post" action="signup.php">
    <fieldset>
        <legend>Sign Up</legend>
    <label for="signup_login">Login: </label>
        <input type="text" id="signup_login" name="login" placeholder="login"></br>
        <label for="signup_pass">Password: </label>
        <input type="password" id="signup_pass" name="pass" placeholder="Password"></br>
        <label for="signup_pass2">Confirm the password: </label>
        <input type="password" id="signup_pass2" name="pass2" placeholder="Password"></br>
        <label for="signup_email">E-mail: </label>
        <input type="email" id="signup_email" name="mail" placeholder="admin@example.by"></br>
        <label for="signup_name">Name: </label>
        <input type="text" id="signup_name" name="name" placeholder="User"></br>
        <input class="but" type="submit" name="submit" value="Sign Up"/>
        <button id="enter" type="submit" formaction="#">Sign In</button>
    </fieldset>
</form>

<?php endif; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="scripts/script.js" type="text/javascript"></script>
</body>
</html>