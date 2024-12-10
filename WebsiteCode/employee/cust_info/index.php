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
$customers = get_customer_info();

include('../../view/header.php');
?>
<section id="admin">
     <h2>Customer Info</h2>
     <form action="../index.php" method="post">
        <button type="submit" value="">Back</button>
     </form>
     <table id="admin_table">
        <tr>
           <th>&nbsp;ID&nbsp;</th>
           <th>&nbsp;First Name&nbsp;</th>
           <th>&nbsp;Last Name&nbsp;</th>
           <th>&nbsp;Email&nbsp;</th>
           <th>&nbsp;Phone Number&nbsp;</th>
        </tr>
        <?php foreach ($customers as $customer) : ?>
         <tr>
            <td><?php echo $customer['customer_id']; ?></td>
            <td><?php echo $customer['first_name']; ?></td>
            <td><?php echo $customer['last_name']; ?></td>
            <td><?php echo $customer['email']; ?></td>
            <td><?php echo $customer['phone_number']; ?></td>
         </tr>
      <?php endforeach; ?>
     </table>
</section>
<?php include('../../view/footer.php'); ?>