<?php

namespace Fluoresce\Svg;

/**
 * SVG image element
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
interface ElementInterface
{
    /**
     * Draw this element as SVG code
     *
     * @return string SVG code
     */
    public function draw();
}
