<?php

declare(strict_types=1);

namespace tagadvance\pimon;

use PHPUnit\Framework\TestCase;

final class TopTest extends TestCase
{
	public function testGetTopData(): void
	{
		$this->assertIsArray(Top::getTopData());
	}

	public function testParse(): void
	{
		$tests = dirname(__DIR__, 3);
		$pathToOutput = implode(DIRECTORY_SEPARATOR, [$tests, 'resources', 'top.txt']);
		$output = file_get_contents($pathToOutput);
		$result = Top::parse($output);

		$this->assertIsArray($result);
		// ensure all values are not null
		$this->assertCount(count(array_filter($result, fn($value) => isset($value))), $result);
	}
}
