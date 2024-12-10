<?php 
include('../../view/header.php');
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
?>
<section id="admin">
     <h2>Which vehicle would you like to leave feedback for?</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>ID</th>
           <th>Start Date</th>
           <th>End Date</th>
           <th>Make</th>
           <th>Model</th>
           <th>Year</th>
           <th>&nbsp;</th>
        </tr>
        <?php foreach ($reservations as $reservation) : ?>
         <tr>
            <td><?php echo $reservation['reservation_id']; ?></td>
            <td><?php echo $reservation['start_date']; ?></td>
            <td><?php echo $reservation['end_date']; ?></td>
            <td><?php echo $reservation['make']; ?></td>
            <td><?php echo $reservation['model']; ?></td>
            <td><?php echo $reservation['year']; ?></td>
            <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="vehicle_selected">
                    <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                    <input type="submit" value="Select">
                </form>
            </td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>