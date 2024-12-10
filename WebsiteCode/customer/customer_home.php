<?php 
include('../view/header.php');
if (!isset($_SESSION['customer_password'])) {
  header("Location: 
    /admin/index.php");
} 
?>
<section id="admin">
     <h2>Customer Portal</h2>

     <form action="make_reservation/index.php" method="post">
        <input type="submit" value="Make Reservation">
     </form>
     
     <form action="customer_reservations/index.php" method="post">
        <input type="submit" value="View My Reservations">
     </form>

     <form action="feedback/index.php" method="post">
        <input type="submit" name="logout" value="Submit Feedback">
     </form>

     <form action="incident/index.php" method="post">
        <input type="submit" name="logout" value="Submit Incident">
     </form>

     <form action="index.php" method="post">
        <input type="submit" name="logout" value="Logout">
     </form>
</section>
<?php include('../view/footer.php'); ?>