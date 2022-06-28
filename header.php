<?php // Example 02: header.php
session_start();


// echo <<<_INIT
// <!DOCTYPE html> 
// <html>
//   <head>
//     <meta charset='utf-8'>
//     <meta name='viewport' content='width=device-width, initial-scale=1'> 
//     <link rel='stylesheet' href='jquery.mobile-1.4.5.min.css'>
//     <link rel='stylesheet' href='styles.css' type='text/css'>
//     <script src='javascript.js'></script>
//     <script src='jquery-2.2.4.min.js'></script>
//     <script src='jquery.mobile-1.4.5.min.js'></script>

// _INIT;

echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel='stylesheet' href='styles.css' type='text/css'>
    <script src='javascript.js'></script>
_INIT;

require_once 'functions.php';

$userstr = 'Welcome Guest';
$randstr = substr(md5(rand()), 0, 7);

if (isset($_SESSION['user'])) {
  $user     = $_SESSION['user'];
  $loggedin = TRUE;
  $userstr  = "Logged in as: $user";
} else $loggedin = FALSE;

echo <<<_MAIN
    <title>Electronics Inventory: $userstr</title>
  </head>
  <body>
    <div data-role='page'>
      <div data-role='header'>
        <div id='logo' class='center'><img id='E_Icon' src='images/E_Icon.png'>Electronics Inventory</div>
        <div class='username'>$userstr</div>
      </div>
      <div data-role='content'>

      

_MAIN;

if ($loggedin) {
  echo <<<_LOGGEDIN
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='home'
            data-transition="slide" href='members.php?view=$user&r=$randstr'>Home</a>
          <a data-role='button' data-inline='true' data-icon='bullets'
            data-transition="slide" href='items_table.php?view=$user&r=$randstr'>Items Table</a>
          <a data-role='button' data-inline='true' data-icon='plus'
            data-transition="slide" href='add_item.php?r=$randstr'>Add New Item</a>
          <a data-role='button' data-inline='true' data-icon='action'
            data-transition="slide" href='logout.php?r=$randstr'>Log out</a>
        </div>
        
_LOGGEDIN;
} else {
  echo <<<_GUEST
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='home'
            data-transition='slide' href='index.php?r=$randstr''>Home</a>
          <a data-role='button' data-inline='true' data-icon='plus'
            data-transition="slide" href='signup.php?r=$randstr''>Sign Up</a>
          <a data-role='button' data-inline='true' data-icon='check'
            data-transition="slide" href='login.php?r=$randstr''>Log In</a>
        </div>
        <p class='info'>(You must be logged in to use this app)</p>
        
_GUEST;
}
