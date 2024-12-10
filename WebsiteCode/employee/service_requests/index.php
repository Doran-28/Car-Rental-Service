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
$service_requests = get_service_requests();

include('../../view/header.php');
?>
<section id="admin">
     <h2>Service Requests</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>&nbsp;Service ID&nbsp;</th>
           <th>&nbsp;Vehicle ID&nbsp;</th>
           <th>&nbsp;Service Company&nbsp;</th>
           <th>&nbsp;Mechanic Name&nbsp;</th>
           <th>&nbsp;Repair Cost&nbsp;</th>
           <th>&nbsp;Repair Date&nbsp;</th>
           <th>&nbsp;Category&nbsp;</th>
           <th>&nbsp;Repair Description&nbsp;</th>
        </tr>
        <?php foreach ($service_requests as $item) : ?>
         <tr>
            <td><?php echo $item['service_id']; ?></td>
            <td><?php echo $item['vehicle_id']; ?></td>
            <td><?php echo $item['service_company']; ?></td>
            <td><?php echo $item['mechanic_name']; ?></td>
            <td><?php echo $item['repair_cost']; ?></td>
            <td><?php echo $item['repair_date']; ?></td>
            <td><?php echo $item['category']; ?></td>
            <td><?php echo $item['repair_desc']; ?></td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>