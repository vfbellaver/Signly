<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dt = 1502265841.1632;
        $ha = Carbon::createFromTimestamp(1502265841)->format('Y-m-d H:i:s');

        $filename = "/Users/ogremagi/Projects/signly/tests/billboards.csv";
        $data = csv_to_array($filename);
        $billboards = [];
        foreach ($data as $row) {
            $billboard = [
                'name' => null,
                'description' => null,
                'address' => null,
                'lat' => null,
                'lng' => null,
            ];
            $billboard = array_intersect_key($row, $billboard);
            $billboard['faces'] = [];

            $i = 1;
            $required = ['code', 'label', 'hard_cost', 'monthly_impressions', 'duration'];
            $optional = ['height', 'width', 'reads', 'notes', 'max_ads', 'lights_on', 'lights_off', 'billboard_id', 'photo', 'is_illuminated'];
            while (isset($row["face{$i}_code"])) {
                $face = [];
                $valid = true;
                foreach ($required as $r) {
                    if (!isset($row["face{$i}_{$r}"]) || !$row["face{$i}_{$r}"]) {
                        $valid = false;
                        break;
                    }
                    $face[$r] = $row["face{$i}_{$r}"];
                }
                if (!$valid) {
                    $i++;
                    continue;
                }
                foreach ($optional as $o) {
                    if (!isset($row["face{$i}_{$o}"]) || !$row["face{$i}_{$o}"]) {
                        continue;
                    }
                    if ($o === 'lights_on' || $o === 'lights_off') {
                        $time = $row["face{$i}_{$o}"];
                        $face[$o] = Carbon::createFromFormat('h:i A', $time)->format('H:i:s');
                        continue;
                    }
                    $face[$o] = $row["face{$i}_{$o}"];
                }
                $billboard['faces'][] = $face;
                $i++;
            }
            $billboards[] = $billboard;
        }
        unset($billboard, $data, $face, $filename, $i, $o, $optional, $r, $required, $row, $time, $valid);

        if (true) ;

    }
}