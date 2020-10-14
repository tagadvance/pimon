<?php

declare(strict_types=1);

namespace tagadvance\pimon;

class Top
{
	private const COMMAND = 'top -b -n 2 -d 0.01 | grep ^top -A 5 | tail -n 6';

	private function __construct()
	{
	}

	public static function getTopData(): TopData
	{
		$output = shell_exec(self::COMMAND);

		return self::parse($output);
	}

	public static function parse(string $output): TopData
	{
		[$top, $tasks, $cpu, $memory, $swap] = explode(PHP_EOL, $output);

		$pattern = '/^top - (\d{2}:\d{2}:\d{2}) up\s+(.*),\s+(\d+) users?,\s+load average: (\d+\.\d{2}), (\d+\.\d{2}), (\d+\.\d{2})$/';
		$matches = [];
		if (preg_match($pattern, $top, $matches)) {
			[$_, $time, $uptime, $users, $loadAverage1Minute, $loadAverage5Minutes, $loadAverage15Minutes] = $matches;
		}

		$pattern = '/^Tasks: (\d+) total,\s+(\d+) running, (\d+) sleeping,\s+(\d+) stopped,\s+(\d+) zombie$/';
		$matches = [];
		if (preg_match($pattern, $tasks, $matches)) {
			[$_, $tasksTotal, $tasksRunning, $tasksSleeping, $tasksStopped, $tasksZombie] = $matches;
		}

		$pattern = '/^%Cpu\(s\):\s+(\d+\.\d+) us,\s+(\d+\.\d+) sy,\s+(\d+\.\d+) ni, (\d+\.\d+) id,\s+(\d+\.\d+) wa,\s+(\d+\.\d+) hi,\s+(\d+\.\d+) si,\s+(\d+\.\d+) st$/';
		$matches = [];
		if (preg_match($pattern, $cpu, $matches)) {
			[$_, $cpuUserSpace, $cpuKernelSpace, $cpuNice, $cpuIdle, $cpuWait, $cpuHardwareInterrupts, $cpuSoftwareInterrupts, $cpuSteal] = $matches;
		}

		$pattern = '/^([KMGTPE]iB) Mem\s*:\s+([0-9.]+) total,\s+([0-9.]+) free,\s+([0-9.]+) used,\s+([0-9.]+) buff\/cache$/';
		$matches = [];
		if (preg_match($pattern, $memory, $matches)) {
			[$_, $memoryUnit, $memoryTotal, $memoryFree, $memoryUsed, $memoryCache] = $matches;
		}

		$pattern = '/^([KMGTPE]iB) Swap:\s+([0-9.]+) total,\s+([0-9.]+) free,\s+([0-9.]+) used\.\s+([0-9.]+) avail Mem\s*$/';
		$matches = [];
		if (preg_match($pattern, $swap, $matches)) {
			[$_, $swapUnit, $swapTotal, $swapFree, $swapUsed, $memoryAvailable] = $matches;
		}

		return new TopData(
			$time,
			$uptime,
			$users,
			$loadAverage1Minute,
			$loadAverage5Minutes,
			$loadAverage15Minutes,
			intval($tasksTotal),
			intval($tasksRunning),
			intval($tasksSleeping),
			intval($tasksStopped),
			intval($tasksZombie),
			$cpuUserSpace,
			$cpuKernelSpace,
			$cpuNice,
			$cpuIdle,
			$cpuWait,
			$cpuHardwareInterrupts,
			$cpuSoftwareInterrupts,
			$cpuSteal,
			$memoryUnit,
			$memoryTotal,
			$memoryFree,
			$memoryUsed,
			$memoryCache,
			$swapUnit,
			$swapTotal,
			$swapFree,
			$swapUsed,
			$memoryAvailable
		);
	}

}