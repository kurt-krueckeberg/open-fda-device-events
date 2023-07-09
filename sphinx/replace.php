<?php

$file = new \SplFileObject("device-adverse-event-searchable-fields.csv", "r");

$newfile = new \SplFileObject("new.csv", "w");

$pattern = "@(^[A-Z][^|]*?)|\([^|]*?\)|(.*)$@";

$replacement = "$1|`$2`|$3";

foreach ($file as $line) {

  $subject = preg_replace($pattern, $replacement, $line);

  $newfile->fwrite($subject);
}

