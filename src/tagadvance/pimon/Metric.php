<?php

declare(strict_types=1);

namespace tagadvance\pimon;

use tagadvance\elephanttophat\Measurement;

class Metric
{
	private int $timestamp;
	private string $hostname;
	private string $service;
	private string $name;
	private $value;
	private ?string $unit;

	public static function createMetric(string $service, string $name, Measurement $measurement)
	{
		static $timestamp, $hostname;
		if (!isset($timestamp, $hostname)) { // TODO: cover with unit test
			$timestamp = time();
			$hostname = gethostname();
		}

		return new self($timestamp, $hostname, $service, $name, $measurement->getValue(), $measurement->getUnit());
	}

	/**
	 * Metric constructor.
	 * @param int $timestamp
	 * @param string $hostname
	 * @param string $service
	 * @param string $name
	 * @param $value
	 * @param ?string $unit
	 */
	public function __construct(int $timestamp, string $hostname, string $service, string $name, $value, ?string $unit)
	{
		$this->timestamp = $timestamp;
		$this->hostname = $hostname;
		$this->service = $service;
		$this->name = $name;
		$this->value = $value;
		$this->unit = $unit;
	}

	/**
	 * @return int
	 */
	public function getTimestamp(): int
	{
		return $this->timestamp;
	}

	/**
	 * @return string
	 */
	public function getHostname(): string
	{
		return $this->hostname;
	}

	/**
	 * @return string
	 */
	public function getService(): string
	{
		return $this->service;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @return ?string
	 */
	public function getUnit(): ?string
	{
		return $this->unit;
	}
}
