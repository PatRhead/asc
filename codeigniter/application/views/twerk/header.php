<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Winthrop | ASC</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/foundation.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css" />
	<?php 
		foreach($seminars->css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($seminars->js_files as $file): ?>
			<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

    <script src="<?php echo base_url(); ?>js/vendor/modernizr.js"></script>
  </head>
  <body>
    <nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">Winthrop University</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="active"><a href="#"><?php echo $username ?></a></li>
      <li class="has-dropdown">
        <a href="#">Options</a>
        <ul class="dropdown">
          <li><a href="<?php echo base_url();?>index.php/auth/logout">Logout</a></li>
        </ul>
      </li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li><a href="#">Left Nav Button</a></li>
    </ul>
  </section>
</nav>
    <!--End Navigation--> 
