<?php


namespace Lorenzschaef\PHPDDDMD;


use PHPMD\AbstractNode;
use PHPMD\Rule\ClassAware;
use PHPMD\Rule\InterfaceAware;

class NoOutwardDependenciesRule extends DDDBaseRule
implements ClassAware, InterfaceAware
{
    /**
     * This method should implement the violation analysis algorithm of concrete
     * rule implementations. All extending classes must implement this method.
     *
     * @param AbstractNode $node
     */
    public function apply(AbstractNode $node)
    {
        $definedLayers = $this->getDefinedLayers();

        $currentLayer = $this->extractLayerName($node->getNamespaceName(), $definedLayers);

        if($currentLayer === false){
            return;
        }

        $references = $node->findChildrenOfType('ClassOrInterfaceReference');
        foreach($references as $reference) {
            $referencedLayer =  $this->extractLayerName($reference->getImage(), $definedLayers);
            if ($this->isOutwardDependency($currentLayer, $referencedLayer, $definedLayers)) {
                $this->addViolation($reference);
            }
        }
    }


    /**
     * This method returns true if the dependencyLayer is further out in list of layers
     * than the currentLayer, representing a case of an illegal dependency in DDD
     *
     * @param string $currentLayer
     * @param string $dependencyLayer
     * @param string[] $definedLayers
     * @return bool
     */
    private function isOutwardDependency($currentLayer, $dependencyLayer, $definedLayers)
    {
        $currentLayerIndex = (int)array_search($currentLayer, $definedLayers);
        $dependencyLayerIndex = (int)array_search($dependencyLayer, $definedLayers);
        return ($currentLayerIndex < $dependencyLayerIndex);
    }

}