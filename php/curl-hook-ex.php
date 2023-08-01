<?php

Co::set(['hook_flags' => OpenSwoole\Runtime::HOOK_ALL]);

Co::run(function()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://openswoole.com");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    curl_close($ch);
    var_dump($result);
});
