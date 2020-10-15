<?php

declare(strict_types=1);

use tagadvance\elephanttophat\Measurement;
use tagadvance\elephanttophat\Top;
use tagadvance\pimon\Metric;
use tagadvance\pimon\Plugin;

class TopPlugin implements Plugin
{
	const SERVICE_NAME = 'top';

	public function getSchedule(array $configuration): ?string
	{
		return $configuration['top_schedule'] ?? null;
	}

	public function getMetrics(array $configuration): array
	{
		$measurements = Top::exec();

		return array_map(
			function (string $name) use ($measurements): ?Metric {
				if (!isset($measurements[$name])) {
					$message = sprintf('Configuration error: missing metric "%s" in %s.', $name, __CLASS__); // TODO: cover with unit test
					throw new RuntimeException($message);
				}

				/** @var Measurement $measurement */
				$measurement = $measurements[$name];
				return Metric::createMetric(self::SERVICE_NAME, $name, $measurement);
			},
			$configuration['top_metrics'] ?? []
		);
	}
}

return new TopPlugin();
