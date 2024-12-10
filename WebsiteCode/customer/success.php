<?php 
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
include('../../view/header.php'); 
?>
<section id="success">
  <h2>Account successfully created, thank you!</h2>
  <a href="index.php"><button>Home</button></a>
</section>
<?php include('../../view/footer.php'); ?>