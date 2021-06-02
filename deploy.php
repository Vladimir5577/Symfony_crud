<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'symfony_app');

// Project repository
set('repository', 'git@github.com:Vladimir5577/Symfony_crud.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);
set('bin_dir', 'bin');
set('var_dir', 'var');

// Shared files/dirs between deploys 
add('shared_files', [
    '.env',
]);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('62.173.140.14')
    ->set('deploy_path', '/var/www/html/dev/Symfony');    
    
// Tasks

task('test', function () {
    // run('cd {{release_path}} && build');
    set('repository', 'git@github.com:Vladimir5577/Symfony_crud.git');
	// set('shared_files', [...]);
//	$result = run('pwd');
//    writeln("Current dir: $result");
});

task('dump:env', function (){
//   run('cd {{release_path}} && composer dump-env prod');
});

task('deploy:assets:install', function (){});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

after('deploy:vendors', 'dump:env');
before('deploy:symlink', 'database:migrate');

