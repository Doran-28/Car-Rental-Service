<?php
session_start();
require_once('../../model/database.php');
require_once('../../model/fields.php');
require_once('../../model/validate.php');
require_once('../../model/employee_db.php');

// Ensures the user is logged in
if (!isset($_SESSION['employee_password'])) {
  header("Location: /employee/index.php");
}

// Pull customer info
$reservations = get_reservations();

include('../../view/header.php');
?>
<section id="admin">
     <h2>Reservation Info</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>ID</th>
           <th>&nbsp;Vehicle_ID&nbsp;</th>
           <th>&nbsp;Customer_ID&nbsp;</th>
           <th>&nbsp;Employee_ID&nbsp;</th>
           <th>&nbsp;Start Date&nbsp;</th>
           <th>&nbsp;End Date&nbsp;</th>
           <th>&nbsp;Total Cost&nbsp;</th>
        </tr>
        <?php foreach ($reservations as $reservation) : ?>
         <tr>
            <td><?php echo $reservation['reservation_id']; ?></td>
            <td><?php echo $reservation['vehicle_id']; ?></td>
            <td><?php echo $reservation['customer_id']; ?></td>
            <td><?php echo $reservation['employee_id']; ?></td>
            <td><?php echo $reservation['start_date']; ?></td>
            <td><?php echo $reservation['end_date']; ?></td>
            <td><?php echo $reservation['total_cost']; ?></td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>