<?php

declare(strict_types=1);

use tagadvance\elephanttophat\Measurement;
use tagadvance\pimon\Metric;
use tagadvance\pimon\Plugin;
use tagadvance\pimon\Units;

class ThermalPlugin implements Plugin
{
	const SERVICE_NAME = 'thermal';
	private const TEMPERATURE_SENSOR = '/sys/class/thermal/thermal_zone0/temp';

	public function getSchedule(array $configuration): ?string
	{
		return $configuration['thermal_schedule'] ?? null;
	}

	public function getMetrics(array $configuration): array
	{
		$metrics = [];

		$metricName = 'cpu_temperature';
		$thermalMetrics = $configuration['thermal_metrics'] ?? [];
		if (in_array($metricName, $thermalMetrics)) {
			$temperatureMeasurement = self::getCpuTemperatureCelsius();
			$metrics[] = Metric::createMetric(self::SERVICE_NAME, $metricName, $temperatureMeasurement);
		}

		$metricName = 'cpu_temperate';
		if (in_array($metricName, $thermalMetrics)) {
			throw new \RuntimeException("$metricName is not supported.");
			// TODO: https://www.nicm.dev/vcgencmd/
		}

		return $metrics;
	}

	// TODO: cover with spec
	public static function getCpuTemperatureCelsius(): Measurement
	{
		$raw = trim(file_get_contents(self::TEMPERATURE_SENSOR));
		$temperature = bcdiv($raw, '1000', 1);

		return new Measurement($temperature, Units::CELSIUS);
	}
}

return new ThermalPlugin();
