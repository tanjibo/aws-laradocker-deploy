<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'aws-laradocker-deploy');

// Project repository
set('repository', 'git@github.com:tanjibo/aws-laradocker-deploy.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('54.146.4.89')
    ->user('deployer') // 这里填写 deployer
    // 并指定公钥的位置
    ->identityFile('~/.ssh/deployerkey')
    ->set('/Users/weaving/aws-laradock-deploy', '~/{{application}}');
    
// Tasks

//task('build', function () {
//    run('cd {{release_path}} && build');
//});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

