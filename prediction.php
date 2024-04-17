<?php
session_start();

require './includes/pdo_connect.php';
$pageTitle = "Fantasy Baseball Predictive Model";

include './includes/inc_header.php';
?>
<main>
    <div class="wrapper">
        <h1 id="predictionYear">Select a year and set the limit</h1>
        <form method="GET" action="">
            <select name="year">
                <?php
                // SQL query to fetch distinct years
                $yearsSql = "SELECT DISTINCT yearID FROM Batting ORDER BY yearID DESC";
                $stmt = $db->prepare($yearsSql);
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
        $offensiveSql = "
        SELECT 
            p.nameFirst,
            p.nameLast,
            SUM((((b.H - b.HR) / (b.AB - b.R - b.HR + b.SF)) + (b.H + b.X2B + (2 * b.X3B) + (3 * b.HR)) / b.AB) + b.SB) AS offensiveScore
        FROM 
            People AS p
        JOIN 
            Batting AS b ON p.playerID = b.playerID
        LEFT JOIN
            AllStarFull AS a ON p.playerID = a.playerID AND b.yearID = a.yearID
        WHERE 
            b.yearID = :year AND a.playerID IS NULL
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            offensiveScore DESC
        LIMIT :limit";

        // SQL query to fetch pitching scores for the selected year
        $pitchingSql = "
        SELECT 
            p.nameFirst,
            p.nameLast,
            SUM(pt.W + pt.GS) AS pitchingScore
        FROM 
            People AS p
        JOIN 
            Pitching AS pt ON p.playerID = pt.playerID
        LEFT JOIN
            AllStarFull AS a ON p.playerID = a.playerID AND pt.yearID = a.yearID
        WHERE 
            pt.yearID = :year AND a.playerID IS NULL
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            pitchingScore DESC
        LIMIT :limit";

        // Prepare and execute the SQL queries using your PDO connection
        $offensiveStmt = $db->prepare($offensiveSql);
        $offensiveStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $offensiveStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $offensiveStmt->execute();

        $pitchingStmt = $db->prepare($pitchingSql);
        $pitchingStmt->bindParam(':year', $selectedYear, PDO::PARAM_INT);
        $pitchingStmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $pitchingStmt->execute();

        // Fetch the results for offensive scores
        $offensiveResults = $offensiveStmt->fetchAll(PDO::FETCH_ASSOC);
        // Display dynamic header
        echo "<h2>Prediction for $selectedYear limited to $limit results</h2>";
        // Generate HTML for the offensive scores table
        $offensiveHtml = '<div class="table-container"><h2>Offensive Scores</h2><table class="table table-bordered">';
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

        // Generate HTML for the pitching scores table
        $pitchingHtml = '<div class="table-container"><h2>Pitching Scores</h2><table class="table table-bordered">';
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

<style>
    .table-container {
        float: left;
        margin-right: 20px; /* Adjust as needed */
    }
</style>

<?php include './includes/inc_footer.php'; ?>
