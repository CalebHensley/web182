<?php
// include 'functions/utility-functions.php';
// include 'functions/names-functions.php';
$fileName = 'names-short-list.txt';

$lineNumber = 0;

$FH = fopen("$fileName", "r");
$nextName = fgets($FH);

while(!feof($FH)) {
    if($lineNumber % 2 == 0) {
        $fullNames[] = trim(substr($nextName, 0, strpos($nextName, " --")));
    }

$lineNumber++;
$nextName = fgets($FH);
}

foreach($fullNames as $fullName) {
    $startHere = strpos($fullName, ",") + 1;
    $firstNames[] = trim(substr($fullName, $startHere));
}

// Get all last names
 foreach ($fullNames as $fullName) {
     $stopHere = strpos($fullName, ",");
     $lastNames[] = substr($fullName, 0, $stopHere);
 }


$validFirstNames = array();
$validLastNames = array();
$validFullNames = array();

for($i = 0; $i < sizeof($fullNames); $i++) {
    // jam the first and last name together without a comma, then test for alpha-only characters
    if(ctype_alpha($lastNames[$i].$firstNames[$i])) {
        array_push($validFirstNames, $firstNames[$i]);
        array_push($validLastNames, $lastNames[$i]);
        array_push($validFullNames, $lastNames[$i] . ", " . $firstNames[$i]);
    }
}

$uniqueFirstNames = array();

for($i = 0; $i < sizeof($validFirstNames); $i++) {
    $uniqueFirstNames[$validFirstNames[$i]] = 1;
}

$uniqueFirstNames = array_keys($uniqueFirstNames);

$lastNames = array();
foreach($fullNames as $fullName) {
    $nameParts = explode(" ", $fullName);
    $lastName = end($nameParts);
    $lastNames[] = $lastName;
}

$uniqueLastNames = array();
for($i = 0; $i < sizeof($validLastNames); $i++) {
    $uniqueLastNames[$validLastNames[$i]] = 1;
}

$uniqueLastNames = array_keys($uniqueLastNames);

$nameCounts = array_count_values($validFirstNames);
$maxCount = max($nameCounts);
$mostCommonName = array_search($maxCount, $nameCounts);

$lastNameCounts = array_count_values($validLastNames);
$maxCountLastName = max($lastNameCounts);
$mostCommonLastName = array_search($maxCountLastName, $lastNameCounts);


// ~~~~~~~~~~~~ Display results ~~~~~~~~~~~~ //

echo '<h1>Names - Results</h1>';

echo '<h2>All Names</h2>';
echo "<p>There are " . sizeof($fullNames) . " total names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($fullNames as $fullName) {
        echo "<li>$fullName</li>";
    }
echo "</ul>";

echo '<h2>All Valid Names</h2>';
echo "<p>There are " . sizeof($validFullNames) . " valid names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($validFullNames as $validFullName) {
        echo "<li>$validFullName</li>";
    }
echo "</ul>";

echo '<h2>Unique Names</h2>';
$uniqueValidNames = (array_unique($validFullNames));
echo ("<p>There are " . sizeof($uniqueValidNames) . " unique names</p>");
echo '<ul style="list-style-type:none">';    
    foreach($uniqueValidNames as $uniqueValidNames) {
        echo "<li>$uniqueValidNames</li>";
    }


echo '<h2>Unique First Names</h2>';
echo "<p>There are " . sizeof($uniqueFirstNames) . " unique first names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($uniqueFirstNames as $uniqueFirstName) {
        echo "<li>$uniqueFirstName</li>";
    }
echo "</ul>";

echo '<h2>Unique Last Names</h2>';
echo "<p>There are " . sizeof($uniqueLastNames) . " unique last names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($uniqueLastNames as $uniqueLastName) {
        echo "<li>$uniqueLastName</li>";
    }
echo "</ul>";

echo '<h2>Most Common First Name</h2>';
echo "<p>The most common first name is $mostCommonName, which appears $maxCount times.</p>";


echo '<h2>Most Common Last Name</h2>';
echo "<p>The most common last name is $mostCommonLastName, which appears $maxCountLastName times.</p>";

?>
