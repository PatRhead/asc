<?php include 'emailheader.php' ?>
<div class="emailform large-8 medium-8 columns">
    <div class="row">
      <div class="large-8 columns">
        <h3><?php echo $header ?></h3>
        <ul>
          <?php 
            foreach($names as $name): ?>
            <li><?php echo $name ?></li>
          <?php endforeach; ?>
        </ul>

      </div>
    </div>
</div>
<?php include 'footer.php'; ?>