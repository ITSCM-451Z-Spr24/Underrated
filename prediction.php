<?php
session_start();

require './includes/pdo_connect.php';
$pageTitle = "Fantasy Baseball Predictive Model";

include './includes/inc_header.php';
?>
<main>
    <div class="wrapper">
        <h1 id="predictionYear">Select a year</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-2023" data-bs-toggle="tab" data-bs-target="#2023" type="button" role="tab" aria-controls="2023" aria-selected="true">2023</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-2022" data-bs-toggle="tab" data-bs-target="#2022" type="button" role="tab" aria-controls="2022" aria-selected="false">2022</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-2021" data-bs-toggle="tab" data-bs-target="#2021" type="button" role="tab" aria-controls="2021" aria-selected="false">2021</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="2023" role="tabpanel" aria-labelledby="tab-2023">2023</div>
			<div class="tab-pane fade" id="2022" role="tabpanel" aria-labelledby="tab-2022">2022</div>
			<div class="tab-pane fade" id="2021" role="tabpanel" aria-labelledby="tab-2021">2021</div>
            <?php
			// Include the appropriate SQL query file based on the selected tab
            if(isset($_GET['year'])) {
                $selectedYear = $_GET['year'];
                if($selectedYear == '2023') {
                    include('sql_query23.php');
                } elseif ($selectedYear == '2022') {
                    include('sql_query22.php');
                } elseif ($selectedYear == '2021') {
                    include('sql_query21.php');
                }
            }
            ?>
        </div>
    </div>
</main>

<?php include './includes/inc_footer.php'; ?>