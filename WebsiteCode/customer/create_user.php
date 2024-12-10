<?php 
include('../view/header.php'); 
?>
<section id="admin_login">
  <form action="index.php" method="post">
    <h2>Please fill in the following.</h2>
    
    <?php if (isset($error)) {
      echo '<p class="error">' . $error . '</p>';
    }?>
    <label for="first_name">Your first name:</label>
    <?php echo $fields->getField('first_name')->getHTML(); ?>
    <input type="text" id="first_name" placeholder="John" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
    <br>

    <label for="last_name">Your last name:</label>
    <?php echo $fields->getField('last_name')->getHTML(); ?>
    <input type="text" id="last_name" placeholder="Doe" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
    <br>

    <label for="email">Your email address:</label>
    <?php echo $fields->getField('email')->getHTML(); ?>
    <input type="text" id="email" placeholder="johndoe@example.com" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <br>
    
    <label for="phone_number">Phone number (will be used as your password):</label>
    <?php echo $fields->getField('phone_number')->getHTML(); ?>
    <input type="text" id="phone_number" placeholder="Must be in 111-222-3333 format." name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>">
    <br>
  
    <button type="submit" name="action" value="submit_new_account">Finish</button>
  </form>

</section>
<?php include('../view/footer.php'); ?>