<?php include 'header.php'; ?>
<div class="row">
      <div class="large-12 columns">
        <h1>Student Dashboard</h1>
      </div>
    </div>
 <div class="row">
      <div class="large-12 medium-12 columns">
      	<div class="panel">
	        <h3>Upcoming Seminars</h3>
		<?php echo $seminars->output; ?>
      	</div>
      </div>
 </div>
 <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <h3>Your Registered Seminars</h3>
	        <?php echo $registered->output; ?>
      	</div>
      </div>
  
 </div>

<?php include 'footer.php'; ?>
