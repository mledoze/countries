<?php
namespace MLD\Converter;
use Symfony\Component\Yaml\Dumper;

/**
 * Class YamlConverter
 */
class YamlConverter extends AbstractConverter {

	/**
	 * @return string data converted to Yaml
	 */
	public function convert() {
		$dumper = new Dumper();
		$inlineLevel = 1;

		return $dumper->dump($this->aCountries, $inlineLevel);
	}
}