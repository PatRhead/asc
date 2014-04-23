<?php include 'adminheader.php'; ?>
<div class="row">
  <div class="large-12 columns">
    <h1>Admin Dashboard</h1>
  </div>
</div>
<div class="row">
  <div class="large-12 medium-12 columns">
   <div class="panel">
     <h3><?php echo $title ?></h3>
     <?php echo $crudOutput->output; ?>
   </div>
 </div>
</div>


<?php include 'footer.php'; ?>
