<?php


namespace Lorenzschaef\PHPDDDMD;


use PDepend\Source\AST\ASTClass;
use PHPMD\AbstractNode;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;

class NoLayerSkippingRule extends DDDBaseRule
implements ClassAware
{

    /**
     * This method should implement the violation analysis algorithm of concrete
     * rule implementations. All extending classes must implement this method.
     *
     * @param \PHPMD\AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        $definedLayers = $this->getDefinedLayers();
        $currentLayer = $this->extractLayerName($node->getNamespaceName(), $definedLayers);

        $permittedLayers = $this->getLayerOfImplementedInterfaces($node, $definedLayers);

        $references = $node->findChildrenOfType('ClassOrInterfaceReference');
        foreach ($references as $reference) {
            $referencedLayer = $this->extractLayerName($reference->getImage(), $definedLayers);
            if (
                $this->isSkippingLayer($currentLayer, $referencedLayer, $definedLayers)
                && in_array($referencedLayer, $permittedLayers) == false
            ) {
                $this->addViolation($reference);
            }
        }
    }


    /**
     * Returns an array of the Layers of the Interfaces that the node implements
     *
     * @param ClassNode $node
     * @param string[] $definedLayers
     * @return array
     */
    private function getLayerOfImplementedInterfaces(ClassNode $node, $definedLayers)
    {
        $layers = [];
        /** @var ASTClass $astNode */
        $astNode = $node->getNode();
        foreach ($astNode->getInterfaces() as $interface) {
            $layers[] = $this->extractLayerName($interface->getNamespaceName(), $definedLayers);
        }
        return array_unique($layers);
    }

    /**
     * This method returns true if the referenced layer is not next to the current
     * layer
     *
     * @param string $currentLayer
     * @param string $referencedLayer
     * @param string[] $definedLayers
     * @return bool
     */
    private function isSkippingLayer($currentLayer, $referencedLayer, $definedLayers)
    {
        $currentLayerIndex = (int)array_search($currentLayer, $definedLayers);
        $calledLayerIndex = (int)array_search($referencedLayer, $definedLayers);
        return (($currentLayerIndex - $calledLayerIndex) > 1);
    }

}