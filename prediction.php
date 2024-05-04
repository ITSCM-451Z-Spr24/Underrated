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

        // SQL query to fetch offensive scores for non-All-Star players for the selected year
        $offensiveStmt = $db->prepare(getOffensiveSql());
        $offensiveStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $offensiveStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $offensiveStmt->execute();

        // SQL query to fetch pitching scores for non-All-Star players for the selected year
        $pitchingStmt = $db->prepare(getPitchingSql());
        $pitchingStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $pitchingStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $pitchingStmt->execute();
        
        // SQL query to fetch offensive scores for All-Star players for the selected year
        $allStarOffensiveStmt = $db->prepare(getAllStarOffensiveSql());
        $allStarOffensiveStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $allStarOffensiveStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $allStarOffensiveStmt->execute();

        // SQL query to fetch pitching scores for All-Star players for the selected year
        $allStarPitchingStmt = $db->prepare(getAllStarPitchingSql());
        $allStarPitchingStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $allStarPitchingStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $allStarPitchingStmt->execute();

        // Fetch the results for non-All-Star offensive scores
        $offensiveResults = $offensiveStmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch the results for non-All-Star pitching scores
        $pitchingResults = $pitchingStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Fetch the results for All-Star offensive scores
        $allStarOffensiveResults = $allStarOffensiveStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Fetch the results for All-Star pitching scores
        $allStarPitchingResults = $allStarPitchingStmt->fetchAll(PDO::FETCH_ASSOC);

        // Display dynamic header
        echo "<h2>Prediction for $selectedYear limited to $limit results</h2>";
        
        // Generate HTML for the non-All-Star offensive scores table
        $offensiveHtml = '<div class="table-container"><h2>Offensive Scores for Non-All-Star Players</h2>';
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

        // Output the non-All-Star offensive scores HTML
        echo $offensiveHtml;

        // Generate HTML for the non-All-Star pitching scores table
        $pitchingHtml = '<div class="table-container"><h2>Pitching Scores for Non-All-Star Players</h2>';
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

        // Output the non-All-Star pitching scores HTML
        echo $pitchingHtml;

        // Generate HTML for the All-Star offensive scores table
        $allStarOffensiveHtml = '<div class="table-container"><h2>Offensive Scores for All-Star Players</h2>';
        $allStarOffensiveHtml .= '<table class="table table-bordered">';
        $allStarOffensiveHtml .= '<thead><tr><th>First Name</th><th>Last Name</th><th>Offensive Score</th></tr></thead><tbody>';
        foreach ($allStarOffensiveResults as $row) {
            $allStarOffensiveHtml .= '<tr>';
            $allStarOffensiveHtml .= '<td>' . $row['nameFirst'] . '</td>';
            $allStarOffensiveHtml .= '<td>' . $row['nameLast'] . '</td>';
            $allStarOffensiveHtml .= '<td>' . $row['allstar_offensiveScore'] . '</td>';
            $allStarOffensiveHtml .= '</tr>';
        }
        $allStarOffensiveHtml .= '</tbody></table></div>';

        // Output the All-Star offensive scores HTML
        echo $allStarOffensiveHtml;

        // Generate HTML for the All-Star pitching scores table
        $allStarPitchingHtml = '<div class="table-container"><h2>Pitching Scores for All-Star Players</h2>';
        $allStarPitchingHtml .= '<table class="table table-bordered">';
        $allStarPitchingHtml .= '<thead><tr><th>First Name</th><th>Last Name</th><th>Pitching Score</th></tr></thead><tbody>';
        foreach ($allStarPitchingResults as $row) {
            $allStarPitchingHtml .= '<tr>';
            $allStarPitchingHtml .= '<td>' . $row['nameFirst'] . '</td>';
            $allStarPitchingHtml .= '<td>' . $row['nameLast'] . '</td>';
            $allStarPitchingHtml .= '<td>' . $row['allstar_pitchingScore'] . '</td>';
            $allStarPitchingHtml .= '</tr>';
        }
        $allStarPitchingHtml .= '</tbody></table></div>';

        // Output the All-Star pitching scores HTML
        echo $allStarPitchingHtml;
    }
    ?>
    </div>
</main>

<?php
include './includes/inc_footer.php';
?>
