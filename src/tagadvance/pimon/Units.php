<?php

declare(strict_types=1);

namespace tagadvance\pimon;

class Units
{
	const BYTE = 'B';
	const MEBIBYTE = 'MiB';
	const CELSIUS = 'C';
	const PERCENT = '%';
	const SECOND = 'S';
	const MILLISECOND = 'MS';
	const ALL_UNITS = [
		self::BYTE,
		self::MEBIBYTE,
		self::CELSIUS,
		self::PERCENT,
		self::MILLISECOND
	];

	private function __construct()
	{
	}
}
