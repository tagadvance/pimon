<?php

declare(strict_types=1);

namespace tagadvance\pimon;

interface Plugin
{
	/**
	 * @param array $configuration The result of parsing the config.ini in the plugin directory (if present)
	 * @return Metric[]
	 */
	public function getMetrics(array $configuration): array;
}
