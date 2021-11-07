<?php
require 'class/DbConnection.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();

// Step 2: Create & run the query
$sql = 'SELECT
*
FROM game LEFT JOIN assignment ON game.assignmentID=assignment.assignmentID
LEFT JOIN referee on assignment.refID=referee.refID
WHERE assignment.status="unassigned" AND game.date>CURRENT_DATE
';
//LEFT JOIN referee on assignment.refID=referee.refID
$vars = [];

$stmt = $db->prepare($sql);
$stmt->execute($vars);

$offers = $stmt->fetchAll();

// Step 4: Output

if (isset($_GET['format']) && $_GET['format'] == 'csv' ) {
    header('Content-Type: text/csv');
    echo "GameID,Field,Date,Status\r\n";

    foreach($offers as $o) {
        echo $o['gameID'] . "," .$o['field'].','.$o['date']
          .','.$o['status']."\r\n";
    }

} else {
    $json = json_encode($offers, JSON_PRETTY_PRINT);

    header('Content-Type: application/json');
    echo $json;
}
