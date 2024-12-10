<?php 
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
include('../../view/header.php'); 
?>
<section id="contact_form">
  <form action="index.php" method="post">
    <h2>Please fill out the following!</h2>
    
    <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
    <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
    <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">

    <label for="date">Date:</label>
    <?php echo $fields->getField('date')->getHTML(); ?>
    <input type="text" id="date" name="date" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($date); ?>">
    <br>  

    <label for="description">Description:</label>
    <?php echo $fields->getField('description')->getHTML(); ?>
    <textarea type="textarea" name="description" rows="5" cols="40" placeholder="Ex: Your incident desription here."><?php echo htmlspecialchars($description); ?></textarea>
    <br>
    
    <button type="submit" name="action" value="submit_feedback">Submit</button>
  </form>

</section>
<?php include('../../view/footer.php'); ?>