<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include './includes/inc_header.php';
require './includes/pdo_connect.php';
require './sql_queries.php'; // Include the SQL query functions
$pageTitle = "Fantasy Baseball Predictive Model";

?>
<main>
    <div class="wrapper">
        <h1 id="predictionYear">Select a year and set the limit</h1>
        <form method="GET" action="">
            <select name="year">
                <?php
                // SQL query to fetch distinct years
                $stmt = $db->prepare(getYearsSql());
                $stmt->execute();
                $years = $stmt->fetchAll(PDO::FETCH_COLUMN);

                // Loop through each year and generate options for the dropdown
                foreach ($years as $year) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select>
            <input type="number" name="limit" min="1" max="100" placeholder="Limit" value="10">
            <input type="submit" value="Submit">
        </form>
    <?php
    // Check if a year is selected
    if(isset($_GET['year'])) {
        $selectedYear = $_GET['year'];
        $limit = isset($_GET['limit']) ? min(max(1, $_GET['limit']), 100) : 10; // Limit the value between 1 and 100
        // SQL query to fetch offensive scores for the selected year
        $offensiveStmt = $db->prepare(getOffensiveSql());
        $offensiveStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $offensiveStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $offensiveStmt->execute();

        $pitchingStmt = $db->prepare(getPitchingSql());
        $pitchingStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $pitchingStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $pitchingStmt->execute();
        
        $AllStarPitchingStmt = $db->prepare(getAllStarPitchingSql());
        $AllStarPitchingStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $AllStarPitchingStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $AllStarPitchingStmt->execute();
	

        $AllStarOffensiveStmt = $db->prepare(getAllStarOffensiveSql());
        $AllStarOffensiveStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $AllStarOffensiveStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $AllStarOffensiveStmt->execute();

        // Fetch the results for offensive scores
        $offensiveResults = $offensiveStmt->fetchAll(PDO::FETCH_ASSOC);
        $AllStarOffensiveResults = $AllStarOffensiveStmt->fetch(PDO::FETCH_ASSOC);
        
        // Display dynamic header
        echo "<h2>Prediction for $selectedYear limited to $limit results</h2>";
        
        // Generate HTML for the offensive scores table
        $offensiveHtml = '<div class="table-container"><h2>Offensive Scores</h2>';
        $offensiveHtml .= "<h3>AllStar Offensive Score: " . $AllStarOffensiveResults['avg_offensiveScore'] . "</h3>";
        $offensiveHtml .= '<table class="table table-bordered">';
        $offensiveHtml .= '<thead><tr><th>First Name</th><th>Last Name</th><th>Offensive Score</th></tr></thead><tbody>';
        foreach ($offensiveResults as $row) {
            $offensiveHtml .= '<tr>';
            $offensiveHtml .= '<td>' . $row['nameFirst'] . '</td>';
            $offensiveHtml .= '<td>' . $row['nameLast'] . '</td>';
            $offensiveHtml .= '<td>' . $row['offensiveScore'] . '</td>';
            $offensiveHtml .= '</tr>';
        }
        $offensiveHtml .= '</tbody></table></div>';

        // Output the offensive scores HTML
        echo $offensiveHtml;

        // Fetch the results for pitching scores
        $pitchingResults = $pitchingStmt->fetchAll(PDO::FETCH_ASSOC);
        $allStarPitchingResults = $AllStarPitchingStmt->fetch(PDO::FETCH_ASSOC);

        // Generate HTML for the pitching scores table
        $pitchingHtml = '<div class="table-container"><h2>Pitching Scores</h2>';
        $pitchingHtml .= "<h3>AllStar Pitching Score: " . $allStarPitchingResults['avg_pitchingScore'] . "</h3>";
        $pitchingHtml .= '<table class="table table-bordered">';
        $pitchingHtml .= '<thead><tr><th>First Name</th><th>Last Name</th><th>Pitching Score</th></tr></thead><tbody>';

        foreach ($pitchingResults as $row) {
            $pitchingHtml .= '<tr>';
            $pitchingHtml .= '<td>' . $row['nameFirst'] . '</td>';
            $pitchingHtml .= '<td>' . $row['nameLast'] . '</td>';
            $pitchingHtml .= '<td>' . $row['pitchingScore'] . '</td>';
            $pitchingHtml .= '</tr>';
        }
        $pitchingHtml .= '</tbody></table></div>';

        // Output the pitching scores HTML
        echo $pitchingHtml;
    }
    ?>
    </div>
</main>

<?php
include './includes/inc_footer.php';
?>
