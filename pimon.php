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

$configuration = parse_ini_file($configIni);
if (!isset($configuration['dsn'])) {
	throw new RuntimeException('Please configure DSN.');
}
$dsn = $configuration['dsn'];
$username = $configuration['username'] ?? null;
$password = $configuration['password'] ?? null;
$defaultSchedule = $configuration['schedule'] ?? DEFAULT_SCHEDULE;
$glob = function (string $glob) {
	if (strpos($glob, DIRECTORY_SEPARATOR) !== 0) {
		$glob = implode(DIRECTORY_SEPARATOR, [__DIR__, $glob]);
	}

	return glob($glob);
};
$pathsToPlugins = array_merge(
	...array_map($glob, $configuration['plugins'] ?? [])
);
if (empty($pathsToPlugins)) {
	throw new RuntimeException('No Plugins detected!');
}

$pdo = new PDO($dsn, $username, $password, [
	\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
]);
//$statement = $pdo->prepare(''); // TODO: create metrics table

/** @var \tagadvance\pimon\Plugin[] $plugins */
$plugins = array_map(
	function (string $pathToPlugin) {
		return require_once $pathToPlugin;
	},
	$pathsToPlugins
);
$metrics = array_map(
	function (\tagadvance\pimon\Plugin $plugin) use ($configuration, $defaultSchedule, $isDryRun): array {
		if ($plugin instanceof \tagadvance\pimon\Plugin) {
			$schedule = $plugin->getSchedule($configuration) ?? $defaultSchedule;
			$cron = Cron\CronExpression::factory($schedule);

			if ($cron->isDue() || $isDryRun) {
				return $plugin->getMetrics($configuration);
			}

			return [];
		} else {
			$message = sprintf('All plugins must implement %s!', \tagadvance\pimon\Plugin::class);
			throw new \RuntimeException($message);
		}
	},
	$plugins
);
$metrics = array_merge(...$metrics);

// TODO: replace dry-run with unit test
if ($isDryRun) {
	$beautify = fn(\tagadvance\pimon\Metric $metric) => sprintf('%s: %s%s', $metric->getName(), $metric->getValue(), $metric->getUnit() ?? '');
	$beautifulMetrics = array_map($beautify, $metrics);
	print 'Metrics:' . PHP_EOL . implode(PHP_EOL, $beautifulMetrics) . PHP_EOL;
	exit;
} else {
	// TODO: insert metrics into database
}

// TODO
//current ip address
// nginx
//Open Files
//df
//network ingress and egress iftop
//disk read ops
//disk write ops
//disk reads
//disk writes
