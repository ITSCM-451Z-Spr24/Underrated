
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
    <h1>Find Hidden Gems: Fantasy Baseball All-Star Misfits</h1>
    <p>This website uses a predictive model to identify players with All-Star potential who were overlooked during the draft. 
      Leverage our insights to build a winning fantasy team!</p>
  </section>
  </div>
</main>

<?php
include './includes/inc_footer.php'; 
?>
