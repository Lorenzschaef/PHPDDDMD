<?php


namespace Lorenzschaef\PHPDDDMD;


use PHPMD\AbstractRule;

abstract class DDDBaseRule extends AbstractRule
{

    public function getDefinedLayers()
    {
        $layersParam = $this->getStringProperty('layers');

        if (preg_match('/^[\w\|]+$/', $layersParam) == false) {
            throw new InvalidRulePropertyException(static::getName(), 'layers', $layersParam);
        }

        return explode('|', $layersParam);
    }

    /**
     * This method extracts the name of the DDD layer from a namespace path
     * Returns false if no part of the namespace path matches one of the defined Layer names
     *
     * @param string $namespaceName
     * @param string[] $definedLayers
     * @return false|string
     */
    protected function extractLayerName($namespaceName, $definedLayers)
    {
        $namespacePath = explode('\\', $namespaceName);
        foreach ($namespacePath as $namespacePart) {
            if (in_array($namespacePart, $definedLayers)) {
                return $namespacePart;
            }
        }
        return false;
    }
}