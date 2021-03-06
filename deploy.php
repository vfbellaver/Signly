<?php

namespace Deployer;

require 'recipe/laravel.php';

$env = readEnv(__DIR__);

// Configuration
set('repository', 'git@github.com:' . $env['DEPLOY_REPOSITORY']);
set('git_tty', false);
set('bin/npm', function () {
    return (string)run('which npm');
});

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
host('stage')
    ->hostname($env['DEPLOY_STAGE_HOSTNAME'])
    ->set('keep_releases', 1)
    ->set('branch', $env['DEPLOY_STAGE_BRANCH'])
    ->user($env['DEPLOY_STAGE_USER'])
    ->set('deploy_path', $env['DEPLOY_STAGE_FOLDER']);

host('production')
    ->hostname('new.signly.com')
    ->set('keep_releases', 2)
    ->set('branch', 'production')
    ->user('forge')
    ->set('deploy_path', "/home/forge/new.signly.com");

// Tasks
desc('Generate laroute');
task('artisan:laroute', function () {
    run('cd {{release_path}};{{bin/php}} artisan laroute:generate');
});

desc('Yarn install');
task('yarn:install', function () {
    run("cd {{release_path}} && {{bin/yarn}}", [
        'timeout' => 3800,
    ]);
});

desc('NPM install');
task('npm:install', function () {
    run("cd {{release_path}} && {{bin/npm}} install", [
        'timeout' => 3800,
    ]);
});

desc('Laravel mixin for production');
task('npm:run', function () {
    run("cd {{release_path}} && {{bin/npm}} run production", [
        'timeout' => 3800,
    ]);
});

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    run('sudo service php7.1-fpm restart');
});

desc('Execute artisan config:clear');
task('artisan:config:clear', function () {
    run('{{bin/php}} {{release_path}}/artisan config:clear');
});

task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',

    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:config:clear',
    'artisan:optimize',
    'artisan:laroute',

    'npm:install',
    'npm:run',

    'artisan:migrate',
    'deploy:symlink',
    'php-fpm:restart',
    'artisan:queue:restart',
    'deploy:unlock',
    'cleanup',
]);

after('deploy', 'success');
after('deploy:failed', 'deploy:unlock');