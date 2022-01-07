<?php

namespace Tests\Fixtures;

class TranslationMissing extends \PHPFUI\Translation\MissingLogger
{
	/**
	 * @var array<string> $missing
	 */
	private array $missing = [];

	/**
	 * @return array<string> $missing
	 */
	public function getMissing() : array
	{
		return $this->missing;
	}

	public function missing(string $missing, string $baseLocale) : string
	{
		$this->missing[] = "`{$missing}` is missing in translation `{$baseLocale}`";

		return $missing;
	}
}
