<?php

function csv_to_array($filename, $delimiter = ',')
{
    if (!$filename) {
        return false;
    }
    $header = null;
    $data = null;

    $handle = @fopen($filename, 'r');
    if (!$handle) {
        return [];
    }


    while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
        $normalizedRow = [];
        foreach ($row as $key => $value) {
            $normalizedRow[trim($key)] = trim($value);
        }
        if (!$header) {
            $header = $normalizedRow;
            continue;
        }
        for ($i = count($normalizedRow); $i < count($header); $i++) {
            $normalizedRow[] = null;
        }
        $data[] = array_combine($header, $normalizedRow);
    }

    fclose($handle);

    return $data;

}

function route_contains($name, $operator = '=')
{
    $route = is_null(request()->route()) ? '' : request()->route()->getName();
    if ($operator == '=') {
        return $route == $name;
    }
    $pos = strpos($route, $name);
    return $pos !== false;
}

function readEnv($basePath = null)
{
    if (!$basePath) {
        $basePath = base_path();
    }

    $pattern = '/([^\=]*)\=([^\n]*)/';
    $envFile = $basePath . '/.env';
    $lines = file($envFile);
    $env = [];
    foreach ($lines as $line) {
        preg_match($pattern, $line, $matches);
        if (!count($matches)) {
            continue;
        }
        $env[$matches[1]] = $matches[2];
    }
    return $env;
}

function updateEnv($data = array())
{
    if (!count($data)) {
        return;
    }

    $pattern = '/([^\=]*)\=[^\n]*/';

    $envFile = base_path() . '/.env';
    $lines = file($envFile);
    $newLines = [];
    foreach ($lines as $line) {
        preg_match($pattern, $line, $matches);

        if (!count($matches)) {
            $newLines[] = $line;
            continue;
        }

        if (!key_exists(trim($matches[1]), $data)) {
            $newLines[] = $line;
            continue;
        }

        $key = trim($matches[1]);
        $value = trim($data[trim($matches[1])]);
        if (strpos($value, ' ')) {
            $value = "\"{$value}\"";
        }
        $newLines[] = "{$key}={$value}\n";
    }

    $newContent = implode('', $newLines);
    file_put_contents($envFile, $newContent);
}