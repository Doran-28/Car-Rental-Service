<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Car Rental Service</title>
    <link rel="stylesheet" type="text/css" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/normalize.css">
    <link rel="shortcut icon" href="/images/fav_icon.ico">
</head>

<!-- the body section -->
<body>
<header>
<a href="/index.php"><img src="/images/main_logo.png" alt="Car Rental Logo" height="300"></a>
<img class="header_text_image" src="/images/header.png" alt="Car Rental Header" height="150">



   <!-- Nav menu -->
    <nav id="nav_menu">
      <ul>
        <?php if (isset($_SESSION['customer_password'])): ?>
        <li><a href="/index.php">Home</a></li>
        <li><a href="/customer/index.php">Customer Portal</a></li>
        <li><a href="/customer/make_reservation/index.php">Make Reservation</a></li>
        <li><a href="/customer/feedback/index.php">Feedback</a></li>
        <li><a href="/customer/incident/index.php">Incidents</a></li>
        <?php elseif (isset($_SESSION['employee_password'])): ?>
        <li><a href="/index.php">Home</a></li>
        <li><a href="/employee/index.php">Employee Portal</a></li>
        <?php else: ?>
        <li><a href="/index.php">Home</a></li>
        <?php endif; ?>
      </ul>
    </nav>


</header>
<main>