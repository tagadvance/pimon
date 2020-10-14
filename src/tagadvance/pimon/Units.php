<?php

declare(strict_types=1);

namespace tagadvance\pimon;

class Unit
{
	const ABSOLUTE = '=';
	const BYTE = 'B';
	const MEBIBYTE = 'MiB';
	const CELSIUS = 'C';
	const PERCENT = '%';
	const SECOND = 'S';
	const MILLISECOND = 'MS';
	const ALL_UNITS = [
		self::ABSOLUTE,
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