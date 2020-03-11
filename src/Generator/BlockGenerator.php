<?php

declare(strict_types = 1);

namespace MagentoCodeGenerator\Generator;

use Laminas\Code\Generator\DocBlockGenerator;

/**
 * Class ControllerGenerator
 *
 * @package MagentoCodeGenerator
 */
class BlockGenerator extends GeneratorAbstract implements GeneratorInterface
{
    /**
     * @var string
     */
    private $extendClass = '\Magento\Framework\View\Element\AbstractBlock';

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name) : self
    {
        $this->generator->setName($name);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function generate() : ?string
    {
        $this->prepareExtendedClass();
        $this->prepareMethods();

        $docBlock = new DocBlockGenerator();
        $docBlock->setLongDescription('This is a block class.');
        $this->generator->setDocBlock($docBlock);

        return $this->processor->generate($this->generator);
    }

    /**
     * @return $this
     */
    private function prepareExtendedClass() : self
    {
        $this->generator->addUse($this->extendClass);
        $this->generator->setExtendedClass('AbstractBlock');

        return $this;
    }

    /**
     * @return $this
     */
    private function prepareMethods() : self
    {
        return $this;
    }
}
