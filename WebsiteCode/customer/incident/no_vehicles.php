<?php 
include('../../view/header.php');
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
?>
<section id="admin">
     <h2>Which vehicle would you like to leave an incident report for?</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <h3>There are no vehicles to leave a report for...<br></br></h3>
</section>
<?php include('../../view/footer.php'); ?>