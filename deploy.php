<?php
namespace Deployer;
require 'recipe/common.php';

// Configuration

set('default_stage', 'test');
set('repository', 'https://github.com/derpixler/easy-wordpress-composer-install.git');

// Servers

server('preview', 'p366988.mittwaldserver.info')
    ->user('p36698')
	->identityFile('~/.ssh/deployer_id_rsa.pub', '~/.ssh/deployer_id_rsa', '')
    ->set('deploy_path', '/home/www/p366988/deployment')
	->set('base_path', '/home/www/p366984')
	->set('sudo', FALSE)
	->set('stage', 'preview' )
	->set('DB_HOST', 'db4686.mydbserver.com' )
	->set('DB_USERNAME', 'p366988' )
	->set('DB_PASSWORD', 'usr_p366988_1' )
	->set('DB_DATABASE', 'Zhivimaq%960' );

server('production', 'p366988.mittwaldserver.info')
    ->user('p36698')
	->identityFile('~/.ssh/deployer_id_rsa.pub', '~/.ssh/deployer_id_rsa', '')
    ->set('deploy_path', '/home/www/p366988/deployment')
	->set('base_path', '/home/www/p366984')
	->set('sudo', FALSE)
	->set('stage', 'preview' )
	->set('DB_HOST', 'db4686.mydbserver.com' )
	->set('DB_USERNAME', 'p366988' )
	->set('DB_PASSWORD', 'usr_p366988_2' )
	->set('DB_DATABASE', 'Zhivimaq%960' );

server('test', '149.58.155.192')
    ->user('p36698')
	->identityFile('~/.ssh/deployer_id_rsa.pub', '~/.ssh/deployer_id_rsa', '')
    ->set('deploy_path', '/var/www/deployment')
	->set('base_path', '/var/www/')
	->set('sudo', TRUE)
	->set('stage', 'test' )
	->set('DB_HOST', 'localhost' )
	->set('DB_USERNAME', 'wordpress' )
	->set('DB_PASSWORD', 'IKiu2eiqu1shahghievoo9teidoc5ipp' )
	->set('DB_DATABASE', 'wordpress' );

desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:backup_db',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:symlink',
    'deploy:clear_paths',
    'deploy:unlock',
    'cleanup',
    'success'
]);

after('deploy', 'success');


/**
 * Backup DB before deploy
 *
 * @siince 02.01.2017
 */
desc('Backup DB');
task('deploy:backup_db', function() {

	$link = run("readlink {{deploy_path}}/current")->toString();
    $currentRelease = substr($link, 0, 1) === '/' ? $link : get('deploy_path') . '/' . $link;

	$backup_dir = get('deploy_path') . '_db_backup';

	// Create the backup dir if it doesn't exist
	run( sprintf("if [ ! -d %s ]; then mkdir -p %s; fi", $backup_dir, $backup_dir ) );

    run(sprintf(
           'mysqldump -h%s -u%s -p%s %s | gzip > %s/%s.sql.gz',
		   get('DB_HOST'),
		   get('DB_USERNAME'),
		   get('DB_PASSWORD'),
		   get('DB_DATABASE'),
           $backup_dir,
           basename( $currentRelease )
       ));

});

/**
 * restore last DB Backup after rollback
 *
 * @siince 02.01.2017
 */
desc('Rollback Deploy');
task('rollback', function() {

    $releases = get('releases_list');

    if (isset($releases[1])) {
        $releaseDir = "{{deploy_path}}/releases/{$releases[1]}";

        // Symlink to old release.
        run("cd {{deploy_path}} && {{bin/symlink}} $releaseDir current");

		// Remove release
        run("rm -rf {{deploy_path}}/releases/{$releases[0]}");

		$link = run("readlink {{deploy_path}}/current")->toString();
	    $currentRelease = substr($link, 0, 1) === '/' ? $link : get('deploy_path') . '/' . $link;

		$backup_dir = get('deploy_path') . 'db_backup';

	    run(sprintf(
	           'gunzip < %s/%s.sql.gz | mysql -h%s -u%s -p%s %s',
	           $backup_dir,
	           basename( $currentRelease ),
			   get('DB_HOST'),
			   get('DB_USERNAME'),
			   get('DB_PASSWORD'),
			   get('DB_DATABASE')
	       ));



        writeln("Rollback to `{$releases[1]}` release was successful.");

    } else {
        writeln("<comment>No more releases you can revert to.</comment>");
    }

} );
