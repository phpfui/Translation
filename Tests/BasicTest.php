<?php

namespace Tests;

use PHPFUI\Translation\Translator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;


class BasicTest extends Base
	{
	public function testBadPluralization() : void
		{
		Translator::setLocale('eng');
		$translated = Translator::trans('[Bad', ['count' => 1]);
		$this->expectException(\PHPFUI\Translation\Exception::class);
		$translated = Translator::trans('[Bad|Really Bad', ['count' => 1]);
		}

	public function testCountInstalledLanguages() : void
		{
		$languages = Translator::getInstalledLanguages();
		$this->assertIsArray($languages, 'Translator::getInstalledLanguages did not return array');
		$this->assertGreaterThanOrEqual(2, \count($languages), 'Less than two test languages found');
		$this->assertContains('eng', $languages);
		$this->assertContains('spa', $languages);
		$this->assertNotContains('.', $languages);
		$this->assertNotContains('..', $languages);
		}

	#[DataProvider('simpleTranslationProvider')]
	public function testInvisibleLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('invisible');
		$translated = Translator::trans($sourceText);
		$this->assertEquals('', $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	public function testMissingBaseTranslation() : void
		{
		Translator::setLocale('spa');
		$translated = Translator::trans('fred');
		$translated = Translator::trans('eythel');
		$this->assertEmpty($this->missing->getMissing());
		}

	public function testMissingTranslation() : void
		{
		Translator::setLocale('eng');
		$translated = Translator::trans('fred');
		$translated = Translator::trans('eythel');
		$this->assertNotEmpty($this->missing->getMissing(), 'Translation fred was found');
		$this->assertCount(2, $this->missing->getMissing());
		}

	#[DataProvider('pluralTranslationProvider')]
	public function testPluralsNoLocale(string $sourceText, string $pluralizedText, int $count) : void
		{
		Translator::setBaseLocale('');
		Translator::setLocale('');
		$parameters = ['count' => $count];
		$translated = Translator::trans($sourceText, $parameters);
		$this->assertEquals($pluralizedText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	#[DataProvider('pluralTranslationProvider')]
	public function testPluralsSameLocale(string $sourceText, string $pluralizedText, int $count) : void
		{
		Translator::setBaseLocale('spa');
		Translator::setLocale('spa');
		$parameters = ['count' => $count];
		$translated = Translator::trans($sourceText, $parameters);
		$this->assertEquals($pluralizedText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	#[DataProvider('simpleTranslationProvider')]
	public function testRawLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('RAW');
		$this->assertNotEquals($sourceText, '');
		$translated = Translator::trans($sourceText);
		$this->assertEquals($sourceText, $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}

	#[DataProvider('simpleTranslationProvider')]
	public function testTransLocale(string $sourceText, string $englishText, string $spanishText) : void
		{
		Translator::setLocale('TRANS');
		$translated = Translator::trans($sourceText);
		$this->assertEquals('TRANS', $translated);
		$this->assertEmpty($this->missing->getMissing(), 'Missing translations found');
		}
	}
