<?php 
include('../view/header.php');
if (!isset($_SESSION['employee_password'])) {
  header("Location: 
    /admin/index.php");
} 
?>
<section id="admin">
     <h2>Employee Portal</h2>

     <form action="cust_info/index.php" method="post">
        <input type="submit" value="View Customer Info ">
     </form>
     
     <form action="reservations/index.php" method="post">
        <input type="submit" value="View Reservations">
     </form>

     <form action="incidents/index.php" method="post">
        <input type="submit" name="logout" value="View Incident Reports">
     </form>

     <form action="feedback/index.php" method="post">
        <input type="submit" name="logout" value="View Feedback">
     </form>

     <form action="inventory/index.php" method="post">
        <input type="submit" name="logout" value="View Inventory">
     </form>

     <form action="service_requests/index.php" method="post">
        <input type="submit" name="logout" value="View Service Requests">
     </form>

     <form action="index.php" method="post">
        <input type="submit" name="logout" value="Logout">
     </form>
</section>
<?php include('../view/footer.php'); ?>