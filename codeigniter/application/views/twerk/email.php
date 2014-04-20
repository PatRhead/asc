<?php include 'emailheader.php' ?>
<div class="emailform large-8 medium-8 columns">
<<<<<<< HEAD
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
=======
  <form>
    <div class="row">
      <div class="large-12 columns">
        <label>Subject Line</label>
        <input type="text" placeholder="Title of the email message here" />
>>>>>>> 91bf1f860905ca6acfb53120b8927a1ea3c38de8
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <label>Email Message</label>
<<<<<<< HEAD
        <textarea name="message" placeholder="Content of the email message here"></textarea>
=======
        <textarea placeholder="Content of the email message here"></textarea>
>>>>>>> 91bf1f860905ca6acfb53120b8927a1ea3c38de8
      </div>
    </div>
    <input type="submit" name="submit" value="Send Email" class="emailbutton small button">
  </form>
  <a href="#" class="emailbutton small button">Send Email</a>
</div>
<?php include 'footer.php'; ?>