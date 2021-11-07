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

$nav = 
'<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="../../css/styles.css" rel="stylesheet" type="text/css">
    
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>
    <title>Referee Report</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">ISRA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="../../index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../ref.html">Refs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../games.html">Games</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../assignment.html">Assignments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../reports.html">Game Report</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../twitter.html">Twitter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="form.php">Referee Report</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <h1 class="display-1"> Report </h1>

';
echo $nav;


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
    //var_dump($offers);
} else {
    echo '<table class="table table-primary table-striped">';
    //$head_data = $offers[0];
    echo '<tr><th>gameID</th><th>Field</th><th>Time</th><th>Date</th><th>AssignmentID</th><th>Position</th><th>Status</th><th>Ref ID</th><th>First Name</th><th>Last Name</th><th>Age</th><th>Ref Grade</th><th>Ref Rating</th></tr>';
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


$bottom = 
'
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>

<script src="js/index.js"></script>
</body>

</html>
';

echo $bottom;