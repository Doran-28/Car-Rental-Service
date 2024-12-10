<?php 
if (!isset($_SESSION['customer_password'])) {
  header("Location: /customer/index.php");
} 
include('../../view/header.php'); 
?>
<section id="contact_form">
  <form action="index.php" method="post">
    <h2>Please fill out the following!</h2>
    
    <label for="start_date">Start of desired rental period:</label>
    <?php echo $fields->getField('start_date')->getHTML(); ?>
    <input type="text" id="start_date" name="start_date" placeholder="Must be in YYYY-MM-DD format" value="<?php echo htmlspecialchars($start_date); ?>">
    <br>  

    <label for="end_date">End of desired rental period:</label>
    <?php echo $fields->getField('end_date')->getHTML(); ?>
    <input type="text" id="end_date" name="end_date" placeholder="Must be in YYYY-MM-DD format"><?php echo htmlspecialchars($end_date); ?></input>
    <br>
    
    <label for="location_id">Please select your desired pickup location:</label>
    <select name="location_id">
      <option value=""> Select an option</option>
      <?php foreach ($locations as $location) : ?>
        <option value="<?php echo $location['location_id']; ?>">
          <?php echo $location['city']; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <br>

    <button type="submit" name="action" value="show_vehicles">Submit</button>
  </form>

</section>
<?php include('../../view/footer.php'); ?>