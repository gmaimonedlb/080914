<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(!isset($_SESSION['session']))
{
    echo "<script>window.location = 'index.php'</script>";
}