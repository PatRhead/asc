<?php include 'emailheader.php' ?>
<div class="emailform large-8 medium-8 columns">
  <form method="POST" action="../sendEmail">
    <div class="row">
      <div class="large-8 columns">
        <input class="send" type="text" name="to" value="<?php echo $rowKey ?>"/>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Subject Line</label>
        <input type="text" name="subject" placeholder="Title of the email message here" />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Email Message</label>
        <textarea name="message" placeholder="Content of the email message here"></textarea>
      </div>
    </div>
    <input type="submit" name="submit" value="Send Email" class="emailbutton small button">
  </form>
</div>
<?php include 'footer.php'; ?>