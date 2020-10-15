<?php

declare(strict_types=1);

use tagadvance\elephanttophat\Measurement;
use tagadvance\pimon\Metric;
use tagadvance\pimon\Plugin;
use tagadvance\pimon\Units;

class PingPlugin implements Plugin
{
	const SERVICE_NAME = 'ping';

	public function getSchedule(array $configuration): ?string
	{
		return $configuration['ping_schedule'] ?? null;
	}

	public function getMetrics(array $configuration): array
	{
		$metricName = 'latency';
		$thermalMetrics = $configuration['ping_metrics'] ?? [];
		if (in_array($metricName, $thermalMetrics) && isset($configuration['ping_address'])) {
			$latencyMeasurement = self::ping($configuration['ping_address']);

			return [
				Metric::createMetric(self::SERVICE_NAME, $metricName, $latencyMeasurement)
			];
		}

		return [];
	}

	public static function ping(string $address): Measurement
	{
		$ping = `ping -c 1 $address | grep 'time='`;

		$pattern = '/^\d+ bytes from (.*): icmp_seq=\d+ ttl=\d+ time=(\d+\.\d{1}) ms$/';
		$matches = [];
		if (preg_match($pattern, $ping, $matches)) {
			[$_, $address, $ms] = $matches;

			return new Measurement($ms, Units::MILLISECOND);
		}

		return new Measurement(999.9, Units::MILLISECOND);
	}
}

return new PingPlugin();
