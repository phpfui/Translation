<?php

namespace Tests;

class Base extends \PHPUnit\Framework\TestCase
	{
	protected ?\Tests\Fixtures\TranslationMissing $missing;

	public static function setUpBeforeClass() : void
		{
		\PHPFUI\Translation\Translator::setTranslationDirectory(__DIR__ . '/translations');
		\PHPFUI\Translation\Translator::setBaseLocale('spa');
		}

	public static function tearDownAfterClass() : void
		{
		\PHPFUI\Translation\Translator::clearCache();
		}

	protected function setUp() : void
		{
		$this->missing = new \Tests\Fixtures\TranslationMissing();
		\PHPFUI\Translation\Translator::setTranslationService();
		\PHPFUI\Translation\Translator::setTranslationMissing($this->missing);
		}

	protected function tearDown() : void
		{
		$this->missing = null;
		}

	/**
	 * @return string[][]
	 *
	 */
	public static function dotTranslationProvider() : array
		{
		return [
			['.season', 'Season', 'Temporada'],
			['.brand', 'Brand', 'Marca'],
			['.code', 'Code', 'Código'],
			['.color', 'Color', 'Colour'],
			['.color.dimension', 'Color Dimension', 'Dimensión'],
			['.color.label', 'Color Label', 'Etiqueta'],
			['.company.code', 'Company Code', 'Codigo de Compañia'],
			['.content.code', 'Content Code', 'Código de Contenido'],
			['.coordinates.code', 'Coordinates Code', 'Código de coordenadas'],
			['.cost', 'Cost', 'Costo'],
			['.creator', 'Creator', 'Creador'],
			['.delivery', 'Delivery', 'Entrega'],
			['.description', 'Description', 'Descripción'],
			['.design.classifications', 'Design Classifications', 'Clasificaciones de Diseño'],
			['.design.main.fabrics', 'Design Main Fabrics', 'Diseño de las Telas Principal'],
			['.design.name', 'Design Name', 'Nombre del Diseño'],
			['.design.number', 'Design Number', 'Número de Diseño'],
			['.design.sub classifications', 'Design Sub Classifications', 'Subclasificaciones de Diseño'],
			['.division', 'Division', 'Código de División'],
			['.name', 'Name', 'Nombre'],
			['.pattern.body', 'Pattern Body', 'Número de patrón'],
			['.pattern.number', 'Pattern Number', 'Número de patrón'],
			['.pre.pack', 'Pre Pack', 'Pre-Pack'],
			['.product.brand.type', 'Product Brand Type', 'Tipo de Producto/Marca'],
			['.size.range', 'Size Range', 'Rango de Tamaños'],
			['.sub.division', 'Sub Division', 'Sub División'],
		];
		}

	/**
	 * @return (int|string)[][]
	 *
	 */
	public static function pluralTranslationProvider() : array
		{
		return [
			['There are no plurals', 'There are no plurals', 3],
			['There are :count plurals', 'There are 3 plurals', 3],
			['There are no brands|There is one brand|There are :count brands', 'There are no brands', 0],
			['There are no brands|There is one brand|There are :count brands', 'There is one brand', 1],
			['There are no brands|There is one brand|There are :count brands', 'There are 2 brands', 2],
			['There are no brands|There is one brand|There are :count brands', 'There are 3 brands', 3],
			['There are no brands|There is one brand|There are :count brands', 'There are no brands', -1],
			['[0]There are no brands|[1]There is one brand|[*]There are :count brands', 'There are no brands', 0],
			['[0]There are no brands|[1]There is one brand|[*]There are :count brands', 'There is one brand', 1],
			['[0]There are no brands|[1]There is one brand|[*]There are :count brands', 'There are 2 brands', 2],
			['[0]There are no brands|[1]There is one brand|[*]There are :count brands', 'There are 3 brands', 3],
			['[0]There are no brands|[1]There is one brand|There are :count brands', 'There are 3 brands', 3],
			['[0]There are no brands|[1]There is one brand|[*]There are :count brands', 'There are no brands', -1],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are no brands', -1],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are no brands', 0],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are under ten brands', 1],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are under ten brands', 9],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are under 100 brands', 10],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are under 100 brands', 99],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are hundreds of brands', 100],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|[*]There are hundreds of brands', 'There are hundreds of brands', 1111],
			['[0]There are no brands|[1,9]There are under ten brands|[10,99]There are under 100 brands|There are hundreds of brands', 'There are hundreds of brands', 1111],
		];
		}

	/**
	 * @return string[][]
	 *
	 */
	public static function simpleTranslationProvider() : array
		{
		return [
			['brand', 'Brand', 'Marca'],
			['code', 'Code', 'Código'],
			['color dimension', 'Color Dimension', 'Dimensión'],
			['color label', 'Color Label', 'Etiqueta'],
			['company code', 'Company Code', 'Codigo de Compañia'],
			['content code', 'Content Code', 'Código de Contenido'],
			['coordinates code', 'Coordinates Code', 'Código de coordenadas'],
			['cost', 'Cost', 'Costo'],
			['creator', 'Creator', 'Creador'],
			['delivery', 'Delivery', 'Entrega'],
			['description', 'Description', 'Descripción'],
			['design classifications', 'Design Classifications', 'Clasificaciones de Diseño'],
			['design main fabrics', 'Design Main Fabrics', 'Diseño de las Telas Principal'],
			['design name', 'Design Name', 'Nombre del Diseño'],
			['design number', 'Design Number', 'Número de Diseño'],
			['design sub classifications', 'Design Sub Classifications', 'Subclasificaciones de Diseño'],
			['division', 'Division', 'Código de División'],
			['name', 'Name', 'Nombre'],
			['pattern body', 'Pattern Body', 'Número de patrón'],
			['pattern number', 'Pattern Number', 'Número de patrón'],
			['pre pack', 'Pre Pack', 'Pre-Pack'],
			['product brand type', 'Product Brand Type', 'Tipo de Producto/Marca'],
			['season', 'Season', 'Temporada'],
			['size range', 'Size Range', 'Rango de Tamaños'],
			['sub division', 'Sub Division', 'Sub División'],
		];
		}
	}
