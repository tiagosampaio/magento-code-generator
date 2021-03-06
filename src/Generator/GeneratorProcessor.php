<?php

declare(strict_types = 1);

namespace MagentoCodeGenerator\Generator;

use Laminas\Code\DeclareStatement;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\FileGenerator;

/**
 * Class GeneratorProcessor
 *
 * @package MagentoCodeGenerator\Generator
 */
class GeneratorProcessor
{
    /**
     * @param ClassGenerator $classGenerator
     *
     * @return string
     */
    public function generate(ClassGenerator $classGenerator) : string
    {
        $fileGenerator = new FileGenerator();
        $this->prepareFile($fileGenerator);

        $this->prepareClass($classGenerator);
        $fileGenerator->setClass($classGenerator);

        return $fileGenerator->generate();
    }

    /**
     * @param FileGenerator $fileGenerator
     *
     * @return $this
     */
    private function prepareFile(FileGenerator $fileGenerator) : self
    {
        // $fileGenerator->setDeclares();

        $fileDocBlock = (new DocBlockGenerator())
            ->setShortDescription('Magento Code Generator')
            ->setLongDescription('This code was generated by the Magento Code Generator library')
            ->setTags([
                [
                    'name'        => 'author',
                    'description' => 'Tiago Sampaio <tiago@tiagosampaio.com>',
                ],
            ]);

        $fileGenerator->setDeclares([DeclareStatement::strictTypes(1)]);
        $fileGenerator->setDocBlock($fileDocBlock);

        return $this;
    }

    /**
     * @param ClassGenerator $classGenerator
     *
     * @return $this
     */
    private function prepareClass(ClassGenerator $classGenerator) : self
    {
        $classDocBlock = $classGenerator->getDocBlock() ?: (new DocBlockGenerator());
        $classDocBlock->setShortDescription("Class {$classGenerator->getName()}");

        $classGenerator->setDocBlock($classDocBlock);

        return $this;
    }
}
