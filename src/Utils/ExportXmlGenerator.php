<?php declare(strict_types = 1);

namespace Contributte\Fio\Utils;

use SimpleXMLElement;

/**
 * XmlGenerator
 */
class ExportXmlGenerator
{

	/**
	 * @param mixed[] $data
	 */
	public static function fromArray(array $data): string
	{
		// Import tag
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><Import></Import>');

		// Orders tag
		$orders = $xml->addChild('Orders');

		// Unload transaction data to XML
		foreach ($data as $t) {
			foreach ($t as $tName => $tProperties) {
				$transaction = $orders->addChild($tName);

				foreach ($tProperties as $propertyName => $propertyValue) {
					// Only properties with value
					if ($propertyValue !== null) {
						$transaction->addChild($propertyName, htmlspecialchars((string) $propertyValue));
					}
				}
			}
		}

		return (string) $xml->asXML();
	}

}
