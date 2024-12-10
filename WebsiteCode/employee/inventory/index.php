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
$inventory = get_inventory();

include('../../view/header.php');
?>
<section id="admin">
     <h2>Inventory</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>&nbsp;Vehicle ID&nbsp;</th>
           <th>&nbsp;Make&nbsp;</th>
           <th>&nbsp;Model&nbsp;</th>
           <th>&nbsp;Year&nbsp;</th>
           <th>&nbsp;Mileage&nbsp;</th>
           <th>&nbsp;Location ID&nbsp;</th>
           <th>&nbsp;Valued_at&nbsp;</th>
           <th>&nbsp;Policy Number&nbsp;</th>
           <th>&nbsp;Service Required&nbsp;</th>
        </tr>
        <?php foreach ($inventory as $item) : ?>
         <tr>
            <td><?php echo $item['vehicle_id']; ?></td>
            <td><?php echo $item['make']; ?></td>
            <td><?php echo $item['model']; ?></td>
            <td><?php echo $item['year']; ?></td>
            <td><?php echo $item['mileage']; ?></td>
            <td><?php echo $item['location_id']; ?></td>
            <td><?php echo $item['valued_at']; ?></td>
            <td><?php echo $item['policy_number']; ?></td>
            <td><?php if ($item['service_required'] == 1 ) { echo "Yes";} else { echo "No"; }; ?></td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>