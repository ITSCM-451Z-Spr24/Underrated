
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
    <p>Offensive score: <br> BABIP (Batting average on balls in play)-<br>This statistic combines a lot of important batting stats (hits, at bats, etc) to get a good gauge on what's considered a “good batting season”<br>
    OPS (on base plus slugging)-<br>This statistic helps determine quality of hits and whether players are getting more bases per hit<br>
    Stolen Bases-<br>Stolen bases are an underrated statistic, especially in fantasy baseball since they're worth 2 points<br>
    Pitching Score:<br>IP (innings pitched)-<br>Pitchers give you a point for each inning pitched, so the more they pitch the more points you'll earn in fantasy<br>
    ERA (earned runs average)-<br>This statistic determines how many points the pitcher gives up to the opposing team. The lower this number the better the pitcher is doing.
    W/L (wins / losses)-<br>The most important team statistic, however pitchers also give you 4 points in fantasy for each win which is significant</p>
  </section>
  </div>
</main>

<?php
include './includes/inc_footer.php'; 
?>
