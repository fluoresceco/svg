<?php

namespace Fluoresce\Svg;

/**
 * SVG image definition
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
interface DefinitionInterface
{
    /**
     * Write this definition as SVG code
     *
     * @return string SVG code
     */
    public function write();
}
