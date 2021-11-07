<?php

/* let you add HTML head, foot etc. */

require '../../../class/DbConnection.php';

// Step 1: Get a datase connection from our helper class
$db = DbConnection::getConnection();
$sql = 'SELECT * FROM referee';
$stmt = $db->prepare($sql);
$vars = [];
$stmt->execute($vars);

$refs = $stmt->fetchAll();
$selects = '';
foreach($refs as $k => $v){
    $selects .= '<option value="'.$v['refID'].'">'.$v['firstName'].' '.$v['lastName'].'</option>';
}


// $form = 
// '<form method="post" action="index.php">
// <label for="referee">Referee:</label><select id="referee" name="referee">'.$selects.'</select>
// <label for="begin">Begin</label><input type="date" name="begin" id="begin">
// <label for="end">End</label><input type="date" name="end" id="end">
// <input type="submit">

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
              <a class="nav-link active" href="">Referee Report</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <h1 class="display-1"> Select Referee  </h1>

    <form method="post" action="index.php?format=table">
<label for="referee"><h3>Referee:</h3></label><select class="form-select" aria-label="Default select example" id="referee" name="referee" required="required">'.$selects.'</select>
<label for="begin"><h3> Begin: </h3> </label><input type="date" name="begin" id="begin" required="required"> </br> 
<label for="end"><h3> End:  </h3> </label><input type="date" name="end" id="end" required="required"> </br> 
<label for="format_csv"><h3> CSV File:  </h3> </label><input type="radio" id="format_csv" name="format" value="csv">
<label for="format_table"><h3> Table:  </h3></label><input type="radio" id="format_table" name="format" value="table">
<input type="submit">



</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>

<script src="js/index.js"></script>
</body>

</html>

';
echo $nav;



// </form>';

// echo $form;

$form = 
'<form method="post" action="index.php?format=table">
<label for="referee">Referee:</label><select id="referee" name="referee">'.$selects.'</select>
<label for="begin">Begin</label><input type="date" name="begin" id="begin">
<label for="end">End</label><input type="date" name="end" id="end">
<label for="format_json">json</label><input type="radio" id="format_json" name="format" value="json">
<label for="format_csv">csv</label><input type="radio" id="format_csv" name="format" value="csv">
<label for="format_table">table</label><input type="radio" id="format_table" name="format" value="table">
<input type="submit">



</form>';

//echo $form;