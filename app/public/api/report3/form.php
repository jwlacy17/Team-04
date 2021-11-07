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

echo $form;