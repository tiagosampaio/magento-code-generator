<?php

declare(strict_types = 1);

namespace MagentoCodeGenerator\Generator;

use Laminas\Code\Generator\BodyGenerator;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\MethodGenerator;

/**
 * Class ControllerGenerator
 *
 * @package MagentoCodeGenerator
 */
class ControllerGenerator extends GeneratorAbstract implements GeneratorInterface
{
    /**
     * @var string
     */
    private $frontendExtendClass = '\Magento\Framework\App\Action\Action';

    /**
     * @var string
     */
    private $adminExtendClass = '\Magento\Backend\App\Action';

    /**
     * @var bool
     */
    private $isAdmin = false;

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
     * @param bool $flag
     *
     * @return $this
     */
    public function setIsAdmin(bool $flag) : self
    {
        $this->isAdmin = $flag;

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
        $docBlock->setLongDescription('This is a controller class.');
        $this->generator->setDocBlock($docBlock);

        return $this->processor->generate($this->generator);
    }

    /**
     * @return $this
     */
    private function prepareExtendedClass() : self
    {
        if (false === $this->isAdmin) {
            $this->generator->addUse($this->frontendExtendClass);
            $this->generator->setExtendedClass('Action');
        }

        if (true === $this->isAdmin) {
            $this->generator->addUse($this->adminExtendClass);
            $this->generator->setExtendedClass('Action');
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function prepareMethods() : self
    {
        $this->prepareExecuteMethod();
        return $this;
    }

    /**
     * @return $this
     */
    private function prepareExecuteMethod() : self
    {
        $method = new MethodGenerator();
        $method->setName('execute');
        $method->setVisibility(MethodGenerator::VISIBILITY_PUBLIC);

        $docBlock = new DocBlockGenerator();
        $docBlock->setShortDescription("Main controller's method.");
        $docBlock->setTag([
            'name'        => 'return',
            'description' => '\Magento\Framework\Controller\ResultInterface',
        ]);
        $method->setDocBlock($docBlock);

        $body = new BodyGenerator();
        $body->setContent('return $this->resultFactory->create();');
        $method->setBody($body->generate());

        $this->generator->addMethodFromGenerator($method);

        return $this;
    }
}
