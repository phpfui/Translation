<?php

namespace Tests;

use PHPFUI\Translation\Translator;

class EnglishTest extends Base
	{
	/**
	 * @dataProvider simpleTranslationProvider
	 */
	public function testEnglishLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('eng');
		$translated = Translator::trans($sourceText);
		$this->assertEquals($englishText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	/**
	 * @dataProvider dotTranslationProvider
	 */
	public function testEnglistDotLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('eng');
		$translated = Translator::trans($sourceText);
		$this->assertEquals($englishText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	/**
	 * @dataProvider simpleTranslationProvider
	 */
	public function testSameLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('spa');
		$translated = Translator::trans($spanishText);
		$this->assertEquals($spanishText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	public function testFallbackTranslation() : void
		{
		Translator::setLocale('eng');
		$translated = Translator::trans('.product.brand.line');
		$this->assertNotEmpty($this->missing->getMissing(), 'Missing translations not reported');
		$this->assertEquals('.product.brand.line', $translated);
		}
	}
