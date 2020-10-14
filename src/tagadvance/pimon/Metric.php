<?php

declare(strict_types=1);

namespace tagadvance\pimon;

class Metric
{
	private int $timestamp;
	private string $hostname;
	private string $service;
	private string $name;
	private string $value;
	private string $unit;

	public static function createMetric(string $service, string $name, string $value, string $unit)
	{
		static $timestamp, $hostname;
		if (!isset($timestamp, $hostname)) { // TODO: cover with unit test
			$timestamp = time();
			$hostname = gethostname();
		}

		return new self($timestamp, $hostname, $service, $name, $value, $unit);
	}

	/**
	 * Metric constructor.
	 * @param int $timestamp
	 * @param string $hostname
	 * @param string $service
	 * @param string $name
	 * @param string $value
	 * @param string $unit
	 */
	public function __construct(int $timestamp, string $hostname, string $service, string $name, string $value, string $unit)
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
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function getUnit(): string
	{
		return $this->unit;
	}
}
