#!/usr/bin/env php
<?php

declare(strict_types=1);
error_reporting(E_ALL);

define('DEFAULT_SCHEDULE', '* * * * *');
define('DEFAULT_PLUGINS_GLOB', 'plugins-enabled/**/*Plugin.php');

$autoload = implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);
require_once $autoload;

// TODO: default exception handler

// TODO: --help
$isDryRun = in_array('--dry-run', $argv); // TODO: refactor

$configIni = implode(DIRECTORY_SEPARATOR, [__DIR__, 'config.ini']);
if (!is_readable($configIni)) {
	throw new RuntimeException('Default configuration is missing!');
}

$config = parse_ini_file($configIni);
if (!isset($config['dsn'])) {
	throw new RuntimeException('Please configure DSN.');
}
$dsn = $config['dsn'];
$username = $config['username'] ?? null;
$password = $config['password'] ?? null;
$defaultSchedule = $config['schedule'] ?? DEFAULT_SCHEDULE;
$pluginsGlob = $config['plugins_glob'];
$pathsToPlugins = glob($config['plugins_glob']);
if (empty($pathsToPlugins)) {
	throw new RuntimeException('No Plugins detected!');
}

$pdo = new PDO($dsn, $username, $password, [
	\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
]);
//$statement = $pdo->prepare(''); // TODO: create metrics table

/** @var \tagadvance\pimon\Plugin[] $plugins */
$pluginTuples = array_map(
	function (string $pathToPlugin) {
		$dir = dirname($pathToPlugin);
		$pathToPluginConfiguration = implode(DIRECTORY_SEPARATOR, [$dir, 'config.ini']);
		return [
			parse_ini_file($pathToPluginConfiguration) ?: [],
			require_once $pathToPlugin
		];
	},
	$pathsToPlugins
);
$metrics = array_map(
	function (array $tuple): array {
		[$configuration, $plugin] = $tuple;
		if ($plugin instanceof \tagadvance\pimon\Plugin) {
			return $plugin->getMetrics($configuration);
		} else {
			$message = sprintf('All plugins must implement %s!', \tagadvance\pimon\Plugin::class);
			throw new \RuntimeException($message);
		}
	},
	$pluginTuples
);
$metrics = array_merge(...$metrics);

if ($isDryRun) {
	var_export($metrics); // TODO: override __toString and beautify output
	exit;
} else {
	// TODO: insert metrics into database
}
