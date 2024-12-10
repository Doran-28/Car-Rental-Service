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
$feedbacks = get_feedback();

include('../../view/header.php');
?>
<section id="admin">
     <h2>Feedback</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>&nbsp;Reservation ID&nbsp;</th>
           <th>&nbsp;Description&nbsp;</th>
           <th>&nbsp;Rating&nbsp;</th>
        </tr>
        <?php foreach ($feedbacks as $feedback) : ?>
         <tr>
            <td><?php echo $feedback['reservation_id']; ?></td>
            <td><?php echo $feedback['description']; ?></td>
            <td><?php echo $feedback['rating']; ?></td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>