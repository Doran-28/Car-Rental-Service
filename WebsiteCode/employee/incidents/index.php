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
$incidents = get_incident_reports();

include('../../view/header.php');
?>
<section id="admin">
     <h2>Incident Info</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>&nbsp;Incident ID&nbsp;</th>
           <th>&nbsp;Reservation ID&nbsp;</th>
           <th>&nbsp;Date&nbsp;</th>
           <th>&nbsp;Description&nbsp;</th>
        </tr>
        <?php foreach ($incidents as $incident) : ?>
         <tr>
            <td><?php echo $incident['incident_id']; ?></td>
            <td><?php echo $incident['reservation_id']; ?></td>
            <td><?php echo $incident['date']; ?></td>
            <td><?php echo $incident['description']; ?></td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>