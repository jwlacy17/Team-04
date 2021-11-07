<?php
require 'class/DbConnection.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();

// $sql = 'SELECT 
//     name, username, 
//     MAX(salary) AS maxSalary, 
//     COUNT(salary) AS offerCount
// FROM student LEFT OUTER JOIN 
//     offer ON student.id = offer.studentId
// GROUP BY username, name';

$refID = intval($_POST['referee']);
$begin = $_POST['begin']; //2021-10-01';
$end = $_POST['end'];

$sql = 'SELECT
*
FROM game LEFT JOIN assignment ON game.assignmentID=assignment.assignmentID
LEFT JOIN referee on assignment.refID=referee.refID
WHERE assignment.refID=:refID AND game.date>:begin AND game.date<:end
';

$vars = [];

$stmt = $db->prepare($sql);
$stmt->bindParam(':end', $end);
$stmt->bindParam(':begin', $begin);
$stmt->bindParam(':refID', $refID);
$stmt->execute();

$offers = $stmt->fetchAll();


//Step 4: Output

// if (isset($_GET['format']) && $_GET['format'] == 'csv' ) {
//     header('Content-Type: text/csv');
//     echo "Name,Username,\"Max Salary\",\"Count of Offers\"\r\n";

//     foreach($offers as $o) {
//         echo $o['name'] . "," .$o['username'].','.$o['maxSalary']
//           .','.$o['offerCount']."\r\n";
//     }

// } else {
//     $json = json_encode($offers, JSON_PRETTY_PRINT);

//     header('Content-Type: application/json');
//     echo $json;
// }


if (isset($_POST['format']) && $_POST['format'] == 'csv' ) {
    header('Content-Type: text/csv');
  //  echo '<table>';
    $head_data = $offers[0];
  //  echo '<tr><th>gameID</th><th>field</th><th>time</th><th>date</th><th>assignmentID</th><th>position</th><th>status</th><th>refID</th><th>firstName</th><th>lastName</th><th>age</th><th>refGrade</th><th>refRating</th></tr>';
    echo "\n";//.'<tr>';
    $row = '';
    foreach ($head_data as $k=> $v){
       // echo '<th>'.htmlspecialchars($k).'</th>';
        $row .= $k.',';
    }
    $row = rtrim($row, ',');
    echo $row;
  //  echo '</tr>';
  //echo "\n";
    foreach($offers as $k => $v) {
        echo "\n";//.'<tr>';
        $row = '';
        foreach ($v as $label => $value) {
          //  echo '<td>';
            $row .= $value.',';
          //  echo '</td>';
        }
        $row = rtrim($row, ',');
        echo $row;
    //    echo '</tr>';
    }
 //   echo '</table>';

} elseif((isset($_POST['format']) && $_POST['format'] == 'json' ) ) {
    $json = json_encode($offers, JSON_PRETTY_PRINT);

    header('Content-Type: application/json');
    echo $json;
    var_dump($offers);
} else {
    echo '<table>';
    //$head_data = $offers[0];
    echo '<tr><th>gameID</th><th>field</th><th>time</th><th>date</th><th>assignmentID</th><th>position</th><th>status</th><th>refID</th><th>firstName</th><th>lastName</th><th>age</th><th>refGrade</th><th>refRating</th></tr>';
  /*  echo "\n".'<tr>';
    foreach ($head_data as $k=> $v){
        echo '<th>'.htmlspecialchars($k).'</th>';
    }
    echo '</tr>';*/
    foreach($offers as $k => $v) {
        echo "\n\t".'<tr>';
        foreach ($v as $label => $value) {
            echo '<td>';
            echo htmlspecialchars($value);
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

