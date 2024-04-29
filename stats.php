
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
    <h1>The Formulas and Statistics used for our predictions!</h1>
    <p>Offensive score: <br>BABIP (Batting average on balls in play) - This statistic combines a lot of important batting stats to get a good gauge on what's considered a “good batting season” </p> 
  </section>
  </div>
</main>

<?php
include './includes/inc_footer.php'; 
?>
