<?php

declare(strict_types = 1);

namespace MagentoCodeGenerator\Generator;

/**
 * Class GeneratorInterface
 *
 * @package MagentoCodeGenerator
 */
interface GeneratorInterface
{
    /**
     * @return string
     */
    public function generate() : ?string;
}
