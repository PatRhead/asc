<?php include 'requestsheader.php' ?>
<div class="emailform large-8 medium-8 columns">
  <h1>Request Seminar</h1>
  <form method="POST" action="./processRequest">
    <div class="row">
      <div class="large-8 columns">
        <label>Seminar Name</label>
        <input type="text" name="name"/>
      </div>
    </div>
    <div class="row">
      <div class="large-8 columns">
        <label>Date and Time of Seminar</label>
        <input type="text" name="timedate" placeholder="Please use format YYYY-MM-DD HH:MM:00"/>
      </div>
    </div>
    <div class="row">
      <div class="large-8 columns">
        <label>Description</label>
        <input type="text" name="desc" placeholder="Short description of the seminar" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Materials</label>
        <textarea name="materials" placeholder="Some materials required by the seminar"></textarea>
      </div>
    </div>
    <input type="submit" name="submit" value="Submit" class="emailbutton small button">
  </form>
</div>
<?php include 'footer.php'; ?>