<?php ob_start(); ?>
<?php include_once "templates/header.php" ?>
  <div class="container-fluid welcome">
    <div class="row h-100">
        <h1 class="col-sm-12 col-md-8 m-auto">Welcome to Velvet Records</h1>
    </div>
  </div>
<?php $content = ob_get_clean(); ?>
<?php require "templates/template.php";?>