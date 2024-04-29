
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include './includes/inc_header.php';
require './includes/pdo_connect.php';
$pageTitle = "Fantasy Baseball Predictive Model";


?>
<main>
<div class="wrapper">
  <section class="hero">
    <h1>current repos</h1>
    <p>Link to current github repo</p>
      <a href="https://github.com/ITSCM-451Z-Spr24/Underrated">repo page</a>

  </section>
  </div>
</main>

<?php
include './includes/inc_footer.php'; 
?>
