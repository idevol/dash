<?php

$domain = 'dash.lndo.site';
$port = '8000';
if (function_exists('yaml_parse')) {
    $lando_config = yaml_parse(file_get_contents(__DIR__ . '/../../.lando.yml'));
    $domain = $lando_config['proxy']['dash'][0];
    $ports = $lando_config['services']['dash']['ports'];
    foreach ($ports as $port_lando) {
        if (str_ends_with($port_lando, ':80')){
            $port = substr($port_lando, 0, -3);
        }
    }
} else {
    error_log('❌ The function "yaml_parse" is needed to get the domain of the URL in the test environment.');
    // https://www.php.net/manual/en/function.yaml-parse.php
}

echo 'http://' . $domain . ':' . $port;
