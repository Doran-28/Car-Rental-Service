<?php 
session_start();
include('./view/header.php'); 
?>
<section id="home">
  <div id="centered">
    <h1>Welcome to Car Rental Services!</h1>
  </div>

  <div id="centered" class="about_me">
    <section id="home_menu">
     <h2>Menu</h2>

     <form action="/customer/index.php" method="post">
        <input type="submit" name="logout" value="Go To Customer Portal">
     </form>

     <form action="/employee/index.php" method="post">
        <input type="submit" value="Go To Employee Portal">
     </form>
</section>
  </div>
</section>
<?php include('./view/footer.php'); ?>