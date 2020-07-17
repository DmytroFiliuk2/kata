<html>
<body>
<?php
require_once 'vendor/autoload.php';
echo phpinfo();
use src\Kernel;
use src\Analyser\TextAnalyser;

$kernel = new Kernel(new TextAnalyser());

?>
<div>
    <form action="/index.php" id="demo" method="post">
        <textarea rows="4" cols="50" name="comment"></textarea>
        <input type="submit" value="Submit">
    </form>
</div>
<?php  $_POST ? $kernel->handleRequest($_POST) : null ?>
