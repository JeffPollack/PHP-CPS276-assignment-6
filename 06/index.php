<form enctype="multipart/form-data" method="post" action="index.php">
    <input type="file" name="myfile"/>
    <input type="submit" value="Analyze Paper"/>
</form>

    
<?php
/*
 * Homework  
 * Jeff Pollack
 * Time logged on assignemt: hours 7
 */
if(!isset($_FILES['myfile'])){
    exit();
}
//print_r( $_FILES['myfile']);  // make sure file comes out okay

// ------ Testing area for regex
//$pattern='/[1-9]{1}/';
//$pattern='/^(\d).*$/';
//$pattern='/^*(\d).*$/';
//$pattern='/^.*[1-9]{1}/';
//$pattern='/[1-9]{1}/';
//$s = '[1-9].[A-Za-z0-9]';
//$pattern='/$s{0}/';
//$pattern='/^[1-9]+/';
//$pattern='/[\s-]([1-9])(?=.)/';
//$pattern='[\s\-]([0-9])(?=.)';
//$pattern='/[0-9\.]{1,}/';
// ------ End Testing area for regex

// Regex for imported file and display if file did not get uploaded
//$pattern='/(\S+)([0-9]){1,}+/';
$pattern='/(\S+)([0-9]){1}/';
$string = file_get_contents($_FILES['myfile']['tmp_name']); // make this the file inport
$matches=array();
$result = preg_match_all($pattern, $string, $matches);
if(!$result){
    echo "There was an Error in the File Upload. Please try again.";
}
// End Regex and file upload

echo "<hr/>";

// ------ Code if a regex is found that can pull first digit on its own
//print_r($matches);
//foreach ($matches as $value) {
//    print_r ($value);
//}
//$matches_count = array_count_values($value);
//print_r($matches_count);
// ------ End code for smart regex pattern

// Just variables
$d1 = 0;
$d2 = 0;
$d3 = 0;
$d4 = 0;
$d5 = 0;
$d6 = 0;
$d7 = 0;
$d8 = 0;
$d9 = 0;

// ------ Catching numbers and incrementing the variables
for($i=0;$i<count($matches[0]);$i++){
    $word = $matches[0][$i];
    // Found filter methods browsing around documentation, will take out decimals also, but it does not matter since only the first digit is taken out
    $word_int = filter_var($word, FILTER_SANITIZE_NUMBER_INT);
    switch($word_int){
        case $word_int{0}==='1': $d1++;
            break;
        case $word_int{0}==='2': $d2++;
            break;
        case $word_int{0}==='3': $d3++;
            break;
        case $word_int{0}==='4': $d4++;
            break;
        case $word_int{0}==='5': $d5++;
            break;
        case $word_int{0}==='6': $d6++;
            break;
        case $word_int{0}==='7': $d7++;
            break;
        case $word_int{0}==='8': $d8++;
            break;
        case $word_int{0}==='9': $d9++;
            break;
        default;
            break;
    }   
}
// End Catching 

// -------- Testing area to make sure the results are breaking down and catching the correct numbers in the array
//$word = filter_var($matches[0][1500], FILTER_SANITIZE_NUMBER_INT);
//$t=  $word{0};
//echo "the second value in array is: $word";
//echo "NEED TO FIND:   $t </br>";
// -------- End Testing Area

// ------ Math and display results portion of code
$total = $d1+$d2+$d3+$d4+$d5+$d6+$d7+$d8+$d9;

$Benford_result = ((($d1/0.301)+($d2/0.176)+($d3/0.125)+($d4/0.097)+($d5/0.079)
+($d6/0.067)+($d7/0.058)+($d8/0.051)+($d9/0.046))/9)/$total;

echo"<table  border ='1'>".
        "<tr>".
            "<th>Digit Count</th>".
        "</tr>".
        "<tr>".
            "<td>$d1 numbers begin with the digit 1</td>".
        "</tr>".
        "<tr>".
            "<td>$d2 numbers begin with the digit 2</td>".
        "</tr>".
        "<tr>".
            "<td>$d3 numbers begin with the digit 3</td>".
        "</tr>".
        "<tr>".
            "<td>$d4 numbers begin with the digit 4</td>".
        "</tr>".
        "<tr>".
            "<td>$d5 numbers begin with the digit 5</td>".
        "</tr>".
        "<tr>".
            "<td>$d6 numbers begin with the digit 6</td>".
        "</tr>".
        "<tr>".
            "<td>$d7 numbers begin with the digit 7</td>".
        "</tr>".
        "<tr>".
            "<td>$d8 numbers begin with the digit 8</td>".
        "</tr>".
        "<tr>".
            "<td>$d9 numbers begin with the digit 9</td>".
        "</tr>".
"</table>";

echo "<hr/>";
echo "Total numbers found in document = $total";
echo "</br>";
echo "Benford's Law result = $Benford_result";
echo "</br><hr/>";

if($Benford_result>=.8&&$Benford_result<=1.2){
    echo "The data is likely authentic";
}elseif($Benford_result>=1.35){
    echo "The data fake";
}elseif($Benford_result>=1.2&&$Benford_result<=1.35){
    echo "The data is likely fake";
}
// ------ End math and display
