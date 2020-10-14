<?php

declare(strict_types=1);

namespace tagadvance\pimon;

class TopData
{
	private string $time;
	private string $uptime;
	private string $users;
	private string $loadAverage1Minute;
	private string $loadAverage5Minutes;
	private string $loadAverage15Minutes;
	private int $tasksTotal;
	private int $tasksRunning;
	private int $tasksSleeping;
	private int $tasksStopped;
	private int $tasksZombie;
	private string $cpuUserSpace;
	private string $cpuKernelSpace;
	private string $cpuNice;
	private string $cpuIdle;
	private string $cpuWait;
	private string $cpuHardwareInterrupts;
	private string $cpuSoftwareInterrupts;
	private string $cpuSteal;
	private string $memoryUnit;
	private string $memoryTotal;
	private string $memoryFree;
	private string $memoryUsed;
	private string $memoryCache;
	private string $swapUnit;
	private string $swapTotal;
	private string $swapFree;
	private string $swapUsed;
	private string $memoryAvailable;

	/**
	 * TopData constructor.
	 * @param string $time
	 * @param string $uptime
	 * @param string $users
	 * @param string $loadAverage1Minute
	 * @param string $loadAverage5Minutes
	 * @param string $loadAverage15Minutes
	 * @param int $tasksTotal
	 * @param int $tasksRunning
	 * @param int $tasksSleeping
	 * @param int $tasksStopped
	 * @param int $tasksZombie
	 * @param string $cpuUserSpace
	 * @param string $cpuKernelSpace
	 * @param string $cpuNice
	 * @param string $cpuIdle
	 * @param string $cpuWait
	 * @param string $cpuHardwareInterrupts
	 * @param string $cpuSoftwareInterrupts
	 * @param string $cpuSteal
	 * @param string $memoryUnit
	 * @param string $memoryTotal
	 * @param string $memoryFree
	 * @param string $memoryUsed
	 * @param string $memoryCache
	 * @param string $swapUnit
	 * @param string $swapTotal
	 * @param string $swapFree
	 * @param string $swapUsed
	 * @param string $memoryAvailable
	 */
	public function __construct(
		string $time, string $uptime, string $users, string $loadAverage1Minute, string $loadAverage5Minutes, string $loadAverage15Minutes,
		int $tasksTotal, int $tasksRunning, int $tasksSleeping, int $tasksStopped, int $tasksZombie,
		string $cpuUserSpace, string $cpuKernelSpace, string $cpuNice, string $cpuIdle, string $cpuWait, string $cpuHardwareInterrupts, string $cpuSoftwareInterrupts, string $cpuSteal,
		string $memoryUnit, string $memoryTotal, string $memoryFree, string $memoryUsed, string $memoryCache,
		string $swapUnit, string $swapTotal, string $swapFree, string $swapUsed, string $memoryAvailable
	)
	{
		$this->time = $time;
		$this->uptime = $uptime;
		$this->users = $users;
		$this->loadAverage1Minute = $loadAverage1Minute;
		$this->loadAverage5Minutes = $loadAverage5Minutes;
		$this->loadAverage15Minutes = $loadAverage15Minutes;
		$this->tasksTotal = $tasksTotal;
		$this->tasksRunning = $tasksRunning;
		$this->tasksSleeping = $tasksSleeping;
		$this->tasksStopped = $tasksStopped;
		$this->tasksZombie = $tasksZombie;
		$this->cpuUserSpace = $cpuUserSpace;
		$this->cpuKernelSpace = $cpuKernelSpace;
		$this->cpuNice = $cpuNice;
		$this->cpuIdle = $cpuIdle;
		$this->cpuWait = $cpuWait;
		$this->cpuHardwareInterrupts = $cpuHardwareInterrupts;
		$this->cpuSoftwareInterrupts = $cpuSoftwareInterrupts;
		$this->cpuSteal = $cpuSteal;
		$this->memoryUnit = $memoryUnit;
		$this->memoryTotal = $memoryTotal;
		$this->memoryFree = $memoryFree;
		$this->memoryUsed = $memoryUsed;
		$this->memoryCache = $memoryCache;
		$this->swapUnit = $swapUnit;
		$this->swapTotal = $swapTotal;
		$this->swapFree = $swapFree;
		$this->swapUsed = $swapUsed;
		$this->memoryAvailable = $memoryAvailable;
	}

	/**
	 * @return string
	 */
	public function getTime(): string
	{
		return $this->time;
	}

	/**
	 * @return string
	 */
	public function getUptime(): string
	{
		return $this->uptime;
	}

	/**
	 * @return string
	 */
	public function getUsers(): string
	{
		return $this->users;
	}

	/**
	 * @return string
	 */
	public function getLoadAverage1Minute(): string
	{
		return $this->loadAverage1Minute;
	}

	/**
	 * @return string
	 */
	public function getLoadAverage5Minutes(): string
	{
		return $this->loadAverage5Minutes;
	}

	/**
	 * @return string
	 */
	public function getLoadAverage15Minutes(): string
	{
		return $this->loadAverage15Minutes;
	}

	/**
	 * @return int
	 */
	public function getTasksTotal(): int
	{
		return $this->tasksTotal;
	}

	/**
	 * @return int
	 */
	public function getTasksRunning(): int
	{
		return $this->tasksRunning;
	}

	/**
	 * @return int
	 */
	public function getTasksSleeping(): int
	{
		return $this->tasksSleeping;
	}

	/**
	 * @return int
	 */
	public function getTasksStopped(): int
	{
		return $this->tasksStopped;
	}

	/**
	 * @return int
	 */
	public function getTasksZombie(): int
	{
		return $this->tasksZombie;
	}

	/**
	 * @return string
	 */
	public function getCpuUserSpace(): string
	{
		return $this->cpuUserSpace;
	}

	/**
	 * @return string
	 */
	public function getCpuKernelSpace(): string
	{
		return $this->cpuKernelSpace;
	}

	/**
	 * @return string
	 */
	public function getCpuNice(): string
	{
		return $this->cpuNice;
	}

	/**
	 * @return string
	 */
	public function getCpuIdle(): string
	{
		return $this->cpuIdle;
	}

	/**
	 * @return string
	 */
	public function getCpuWait(): string
	{
		return $this->cpuWait;
	}

	/**
	 * @return string
	 */
	public function getCpuHardwareInterrupts(): string
	{
		return $this->cpuHardwareInterrupts;
	}

	/**
	 * @return string
	 */
	public function getCpuSoftwareInterrupts(): string
	{
		return $this->cpuSoftwareInterrupts;
	}

	/**
	 * @return string
	 */
	public function getCpuSteal(): string
	{
		return $this->cpuSteal;
	}

	/**
	 * @return string
	 */
	public function getMemoryUnit(): string
	{
		return $this->memoryUnit;
	}

	/**
	 * @return string
	 */
	public function getMemoryTotal(): string
	{
		return $this->memoryTotal;
	}

	/**
	 * @return string
	 */
	public function getMemoryFree(): string
	{
		return $this->memoryFree;
	}

	/**
	 * @return string
	 */
	public function getMemoryUsed(): string
	{
		return $this->memoryUsed;
	}

	/**
	 * @return string
	 */
	public function getMemoryCache(): string
	{
		return $this->memoryCache;
	}

	/**
	 * @return string
	 */
	public function getSwapUnit(): string
	{
		return $this->swapUnit;
	}

	/**
	 * @return string
	 */
	public function getSwapTotal(): string
	{
		return $this->swapTotal;
	}

	/**
	 * @return string
	 */
	public function getSwapFree(): string
	{
		return $this->swapFree;
	}

	/**
	 * @return string
	 */
	public function getSwapUsed(): string
	{
		return $this->swapUsed;
	}

	/**
	 * @return string
	 */
	public function getMemoryAvailable(): string
	{
		return $this->memoryAvailable;
	}
}