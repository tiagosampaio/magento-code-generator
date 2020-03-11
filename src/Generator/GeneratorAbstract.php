<?php

declare(strict_types = 1);

namespace MagentoCodeGenerator\Generator;

use Laminas\Code\Generator\ClassGenerator;

/**
 * Class GeneratorAbstract
 *
 * @package MagentoCodeGenerator\Generator
 */
abstract class GeneratorAbstract
{
    /**
     * @var ClassGenerator
     */
    protected $generator;

    /**
     * @var GeneratorProcessor
     */
    protected $processor;

    /**
     * GeneratorAbstract constructor.
     */
    public function __construct()
    {
        $this->processor = new GeneratorProcessor();
        $this->generator = new ClassGenerator();
    }
}
