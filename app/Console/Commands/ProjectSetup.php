<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectSetup extends Command
{

    protected $signature = 'project:setup';

    protected $description = 'Setup project info';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dir = basename(base_path());
        $this->updateEnv(['APP_NAME' => $this->ask('APP_NAME?', title_case($dir))]);

        $this->updateEnv(['DB_DATABASE' => $this->ask('DB_DATABASE?', $dir)]);
        $this->updateEnv(['DB_USERNAME' => $this->ask('DB_USERNAME?', "root")]);
        $this->updateEnv(['DB_PASSWORD' => trim($this->ask('DB_PASSWORD?', " "))]);

        $this->updateEnv(['DEPLOY_STAGE_HOST' => $this->ask("DEPLOY_STAGE_HOST?", 'clevermage.com')]);
        $this->updateEnv(['DEPLOY_STAGE_BRANCH' => $this->ask("DEPLOY_STAGE_BRANCH?", 'master')]);
        $this->updateEnv(['DEPLOY_STAGE_USER' => $this->ask("DEPLOY_STAGE_USER?", 'forge')]);

        $default = kebab_case($dir);
        $this->updateEnv(['DEPLOY_STAGE_FOLDER' => $this->ask("DEPLOY_STAGE_FOLDER?", "/home/forge/{$default}.clevermage.com")]);

        $env = $this->readEnv();

        if ($this->confirm('Would you like to create the database?', true)) {
            $password = "";
            if ($env['DB_PASSWORD']) {
                $password = "-p{$env['DB_PASSWORD']}";
            }
            $cmd = <<<cmd
            mysql -u {$env['DB_USERNAME']} $password -e "drop database if exists {$env['DB_DATABASE']}; create database {$env['DB_DATABASE']};"
cmd;
            shell_exec($cmd);

            $msg = <<<msg
********************
GREAT! ALMOST THERE.
run:
    php artisan migrate --seed
    php artisan passport:install
********************
msg;
            $this->info($msg);
        }
    }

    private function updateEnv($data = array())
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

    private function readEnv()
    {
        $pattern = '/([^\=]*)\=([^\n]*)/';
        $envFile = base_path() . '/.env';
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
}
