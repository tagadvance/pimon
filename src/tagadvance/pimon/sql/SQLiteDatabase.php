<?php

declare(strict_types=1);

namespace tagadvance\pimon;

use PDO;

class Database
{
	private PDO $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pro = $pdo;
	}

	public function createMetricsTable(): void
	{
		// CREATE DATABASE IF NOT EXISTS `pimon` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
		$sql = <<<SQL
			CREATE TABLE IF NOT EXISTS `metrics` (
			  `timestamp` TIMESTAMP NOT NULL,
			  `hostname` VARCHAR(255) NOT NULL,
			  `service` VARCHAR(255) NOT NULL,
			  `name` VARCHAR(255) NOT NULL,
			  `value` VARCHAR(255) NOT NULL,
			  `unit` VARCHAR(3) NULL,
			  INDEX `timestamp` (`timestamp` ASC),
			  INDEX `hostname` (`hostname` ASC),
			  INDEX `service` (`service` ASC),
			  INDEX `name` (`name` ASC)
			);
		SQL;

	}

}
