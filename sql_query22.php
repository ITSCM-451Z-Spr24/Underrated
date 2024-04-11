<?php
// SQL query to fetch data for year 2023
$sql = "SELECT * FROM your_table WHERE year = '2023'";

// Execute the SQL query using your PDO connection
$stmt = $db->prepare($sql);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate HTML for the table
$html = '<table class="table table-bordered">';
foreach ($results as $row) {
    $html .= '<tr>';
    foreach ($row as $value) {
        $html .= '<td>' . $value . '</td>';
    }
    $html .= '</tr>';
}
$html .= '</table>';

// Output the HTML
echo $html;
?>
