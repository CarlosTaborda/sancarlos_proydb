<!DOCTYPE html>
<html>
<title><?= empty($page_title)? "title": $page_title ?></title>
<link rel="shortcut icon" href="<?= base_url("assets/img/favicon.ico") ?>" type="image/x-icon">
<link rel="icon" href="<?= base_url("assets/img/favicon.ico") ?>" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="<?= base_url("assets/plugins/toastr/toastr.min.css") ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url("assets/plugins/toastr/toastr.min.js") ?>"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<?php if( !empty($load_files) ): ?>
<?php foreach($load_files as $f): ?>
<?= $f."\n" ?>
<?php endforeach; ?>
<?php endif; ?>
<body>
<input type="hidden" id="site-url" value="<?=base_url()?>" />

<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="max-width: 12em;">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="#" class="w3-bar-item w3-button">Link 1</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="<?= site_url("Users/logout") ?>" class="w3-bar-item w3-button">Salir</a>
</div>

<!-- Page Content -->
<div style="margin-left:12em" id="<?= empty($id_window)? "id-window": $id_window ?>">

<div class="w3-container w3-indigo">
  <h1><?= empty($page_title)? "title": $page_title ?></h1>
</div>