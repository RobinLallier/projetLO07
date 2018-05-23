<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 18:52
 */

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;