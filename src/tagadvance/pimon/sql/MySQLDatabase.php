<?php

declare(strict_types=1);

namespace tagadvance\pimon\sql;

use tagadvance\pimon\Metric;

class MySQLDatabase extends Database
{
	public function createMetricsTable(): void
	{
		$sql = <<<SQL
			CREATE TABLE IF NOT EXISTS `metrics` (
			  `timestamp` TIMESTAMP NOT NULL,
			  `hostname` VARCHAR(255) NOT NULL,
			  `service` VARCHAR(255) NOT NULL,
			  `name` VARCHAR(255) NOT NULL,
			  `value` VARCHAR(255) NOT NULL,
			  `unit` VARCHAR(3) NULL
			);
		SQL;

		$this->pdo->exec($sql);
	}

	public function collectGarbage(int $days): void
	{
		if ($days === 0) {
			$sql = "TRUNCATE TABLE `metrics`";
			$this->pdo->exec($sql);
		}

		$sql = "DELETE FROM `metrics` WHERE `timestamp` < DATE_SUB(NOW(), INTERVAL $days DAY)";
		$this->pdo->exec($sql);
	}

	public function insertMetric(Metric $metric)
	{
		$sql = <<<SQL
			INSERT INTO `metrics` (`timestamp`, `hostname`, `service`, `name`, `value`, `unit`)
			VALUES (FROM_UNIXTIME(:timestamp), :hostname, :service, :name, :value, :unit);
		SQL;
		$statement = $this->pdo->prepare($sql);
		$statement->execute([
			':timestamp' => $metric->getTimestamp(),
			':hostname' => $metric->getHostname(),
			':service' => $metric->getService(),
			':name' => $metric->getName(),
			':value' => $metric->getValue(),
			':unit' => $metric->getUnit()
		]);
	}
}
