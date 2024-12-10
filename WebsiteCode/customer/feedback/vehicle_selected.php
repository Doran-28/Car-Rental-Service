<?php 
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
include('../../view/header.php'); 
?>
<section id="contact_form">
  <form action="index.php" method="post">
    <h2>Please fill out the following!</h2>
    
    <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation_id); ?>">

    <label for="rating">Rating (1-10):</label>
    <?php echo $fields->getField('rating')->getHTML(); ?>
    <input type="text" id="rating" name="rating" placeholder="Ex: 10" value="<?php echo htmlspecialchars($rating); ?>">
    <br>  

    <label for="description">Feedback:</label>
    <?php echo $fields->getField('description')->getHTML(); ?>
    <textarea type="textarea" name="description" rows="5" cols="40" placeholder="Ex: Your feedback here."><?php echo htmlspecialchars($description); ?></textarea>
    <br>
    
    <button type="submit" name="action" value="submit_feedback">Submit</button>
  </form>

</section>
<?php include('../../view/footer.php'); ?>