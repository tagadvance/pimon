<?php

declare(strict_types=1);

namespace tagadvance\pimon;

interface Plugin
{
	/**
	 * @param array $configuration
	 * @return ?string A cron expression
	 */
	public function getSchedule(array $configuration): ?string;

	/**
	 * @param array $configuration
	 * @return Metric[]
	 */
	public function getMetrics(array $configuration): array;
}
