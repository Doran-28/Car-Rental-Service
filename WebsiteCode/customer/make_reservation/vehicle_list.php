<?php 
include('../../view/header.php');
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
?>
<section id="admin">
     <h2>Which vehicle would you like to reserve?</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>ID</th>
           <th>Make</th>
           <th>Model</th>
           <th>Year</th>
           <th>Mileage</th>
           <th>&nbsp;</th>
        </tr>
        <?php foreach ($vehicles as $vehicle) : ?>
         <tr>
            <td><?php echo $vehicle['vehicle_id']; ?></td>
            <td><?php echo $vehicle['make']; ?></td>
            <td><?php echo $vehicle['model']; ?></td>
            <td><?php echo $vehicle['year']; ?></td>
            <td><?php echo $vehicle['mileage']; ?></td>
            <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="vehicle_selected">
                    <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['vehicle_id']; ?>">
                    <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
                    <input type="hidden" name="valued_at" value="<?php echo $vehicle['valued_at']; ?>">
                    <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">

                    <input type="submit" value="Select">
                </form>
            </td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>