<?php

/**
 * Nette TreeView example bootstrap file.
 *
 * @copyright  Copyright (c) 2010 Roman Novák
 * @package    nette-treeview
 */



// Step 1: Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';



// Step 2: Configure environment
// 2a) enable Nette\Debug for better exception and error visualisation

Debug::enable(false);
Debug::enableProfiler();

// 2b) load configuration from config.ini file
Environment::loadConfig();
Environment::getSession()->start();

dibi::connect(Environment::getConfig('database'));

// Step 3: Configure application
// 3a) get and setup a front controller
$application = Environment::getApplication();
//$application->errorPresenter = 'Error';
$application->catchExceptions = false;



// Step 4: Setup application router
$router = $application->getRouter();

$router[] = new Route('index.php', array(
	'presenter' => 'Homepage',
	'action' => 'default',
), Route::ONE_WAY);

$router[] = new Route('<presenter>/<action>/<id>', array(
	'presenter' => 'Homepage',
	'action' => 'default',
	'id' => NULL,
));



// Step 5: Run the application!
$application->run();
