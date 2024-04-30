<?php

function load_full_names($fileName) {
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
    return $fullNames;
}

function extractNames($filename) {
    $fullNames = array();
    $file = fopen($filename, "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            if (preg_match('/([A-Za-z]+), ([A-Za-z]+)/', $line, $matches)) {
                $fullName = $matches[1] . ' ' . $matches[2];
                $fullNames[] = $fullName;
            }
        }
        fclose($file);
    } else {
        echo "Unable to open file";
    }
    return $fullNames;
}

$fullNames = extractNames("names-short-list.txt");