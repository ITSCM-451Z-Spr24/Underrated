<?php
session_start();

require './includes/pdo_connect.php';
$pageTitle = "Fantasy Baseball Predictive Model";

include './includes/inc_header.php';
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

<?php include './includes/inc_footer.php'; ?>