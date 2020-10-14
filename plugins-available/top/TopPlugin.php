<?php

declare(strict_types=1);

class TopPlugin implements \tagadvance\pimon\Plugin
{
	const SERVICE_NAME = 'top';

	public function getMetrics(array $configuration): array
	{
		$topData = \tagadvance\pimon\Top::getTopData();

		return array_map(
			function (string $name) use ($topData): ?\tagadvance\pimon\Metric {
				if (!isset($topData[$name])) {
					$message = sprintf('Configuration error: missing metric "%s" in %s.', $name, __CLASS__); // TODO: cover with unit test
					throw new RuntimeException($message);
				}

				if (is_array($topData[$name])) {
					[$value, $unit] = $topData[$name];
				} else {
					$value = $topData[$name];
					$unit = \tagadvance\pimon\Units::ABSOLUTE;
				}

				return \tagadvance\pimon\Metric::createMetric(self::SERVICE_NAME, $name, $value, $unit);
			},
			$configuration['metrics'] ?? []
		);
	}
}

return new TopPlugin();
