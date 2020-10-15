<?php

declare(strict_types=1);

namespace tagadvance\pimon\sql;

use PDO;
use PDOException;
use tagadvance\pimon\Metric;

abstract class Database
{
	private const DRIVER_SQLITE = 'sqlite';
	private const DRIVER_MYSQL = 'mysql';

	protected PDO $pdo;

	public static function getDatabase(PDO $pdo): Database
	{
		$driverName = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
		switch ($driverName) {
			case self::DRIVER_SQLITE:
				return new SQLiteDatabase($pdo);
			case self::DRIVER_MYSQL:
				return new MySQLDatabase($pdo);
			default:
				$message = sprintf('Drivers of type "%s" are not supported at this time!', $driverName);
				throw new \RuntimeException($message);
		}
		exit;
	}

	protected function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public abstract function createMetricsTable(): void;

	public abstract function collectGarbage(int $days): void;

	public function insertMetrics(Metric ...$metrics)
	{
		try {
			$this->pdo->beginTransaction();
			foreach ($metrics as $metric) {
				$this->insertMetric($metric);
			}
			$this->pdo->commit();
		} catch (PDOException $e) {
			$this->pdo->rollBack();

			throw $e;
		}
	}

	public abstract function insertMetric(Metric $metric);

	public function selectMetrics(): array
	{
		$sql = 'SELECT * FROM `metrics`';
		$statement = $this->pdo->prepare($sql);
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
}
