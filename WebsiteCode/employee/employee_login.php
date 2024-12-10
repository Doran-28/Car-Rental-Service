<?php 
include('../view/header.php'); 
?>
<section id="admin_login">
  <form action="index.php" method="post">
    <h2>Please login to continue.</h2>
    
    <?php if (isset($error)) {
      echo '<p class="error">' . $error . '</p>';
    }?>
    <label for="username">Employee ID:</label>
    <input type="text" id="username" name="username">
    <br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
  
    <button type="submit" name="action" value="request_login">Log In</button>
  </form>

</section>
<?php include('../view/footer.php'); ?>