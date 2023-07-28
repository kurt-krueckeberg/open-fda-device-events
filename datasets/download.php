<?php
declare(strict_types=1);

if ($argc  != 2) die(".json file missing");

$str = file_get_contents($argv[1]));

$json = json_decode($str);

function download(string $file) {

    $cmd = "curl -O " . $file; // download with same filename.

    exec($cmd);
}

foreach($json->results->device->event->partitions as $partition) {

    download($partition->file);
}
    
