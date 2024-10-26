<?php

function get_domain(): array {
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
        error_log('The function "yaml_parse" is needed to get the domain of the URL in the test environment.');
        // https://www.php.net/manual/en/function.yaml-parse.php
    }
    return [
        'domain' => $domain,
        'port' => $port
    ];
}

function contains($url): string {
    return str_contains($url, 'dash') ? $url : '';
}

function out_calc(): string {
    $lando_info = getenv('LANDO_INFO');
    $domain = get_domain();
    $out = 'http://' . $domain['domain'] . ':' . $domain['port'] . '/';
    if (is_array($lando_info)) {
        $lando_info_array=json_decode($lando_info, TRUE);
        if (isset($lando_info_array['dash']) && isset($lando_info_array['dash']['urls'])){
            $urls = $lando_info_array['dash']['urls'];
            if (count($urls) > 0) {
                $url_cal = array_map('contains', $urls);
                $out = '';
                foreach ($url_cal as $value) {
                    if ($value != '') {
                        $out = $value;
                        break;
                    }
                }
            }
        }
    }
    return $out;
}
$url_out=out_calc();
print_r(substr($url_out, 0, -1));