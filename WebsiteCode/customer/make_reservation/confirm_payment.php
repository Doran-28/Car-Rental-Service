<?php 
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
include('../../view/header.php'); 
?>
<section id="contact_form">
  <form action="index.php" method="post">
    <h2>Please fill out the following to confirm credit card payment.</h2>

    <h3>Total cost of renting amounts to: <?php echo htmlspecialchars($result); ?></h3>
    <br>
    
    <label for="name">Name on card:</label>
    <?php echo $fields->getField('name')->getHTML(); ?>
    <input type="text" id="name" name="name" placeholder="Ex: John Doe" value="<?php echo htmlspecialchars($name); ?>">
    <br>  

    <label for="card_number">Card number:</label>
    <?php echo $fields->getField('card_number')->getHTML(); ?>
    <input type="text" id="card_number" name="card_number" placeholder="Ex: 1111 2222 3333 4444"><?php echo htmlspecialchars($card_number); ?></input>
    <br>

    <label for="CVV">CVV:</label>
    <?php echo $fields->getField('CVV')->getHTML(); ?>
    <input type="text" id="CVV" name="CVV" placeholder="Ex: 222"><?php echo htmlspecialchars($CVV); ?></input>
    <br>

    <input type="hidden" id="vehicle_id" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
    <input type="hidden" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
    <input type="hidden" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
    <input type="hidden" id="result" name="result" value="<?php echo $result; ?>">

    <button type="submit" name="action" value="confirm_reservation">Submit</button>
  </form>

</section>
<?php include('../../view/footer.php'); ?>