<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 17:16
 */
session_start();

if(isset($_SESSION['username'], $_SESSION['password'])){
  session_unset();
  session_destroy();
  header("location: ../login.html");
};