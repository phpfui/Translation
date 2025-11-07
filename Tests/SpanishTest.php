<?php

namespace Tests;

use PHPFUI\Translation\Translator;
use PHPUnit\Framework\Attributes\DataProvider;

class SpanishTest extends Base
	{
	#[DataProvider('simpleTranslationProvider')]
	public function testSameLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('spa');
		$translated = Translator::trans($spanishText);
		$this->assertEquals($spanishText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	#[DataProvider('dotTranslationProvider')]
	public function testSpanishDotLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('spa');
		$translated = Translator::trans($sourceText);
		$this->assertEquals($spanishText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}
	}
