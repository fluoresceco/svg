<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractTag;
use Fluoresce\Svg\ElementInterface;

/**
 * Polygon
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Polygon extends AbstractTag implements ElementInterface
{
    /**
     * @var array Points
     */
    protected $points = [];

    /**
     * @param array $coordinates
     *
     * @return RoundedPolygon
     */
    public function addPoint($coordinates)
    {
        $this->validateCoordinates($coordinates);
        $this->points[] = $coordinates;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function draw()
    {
        $path = '';

        if (count($this->points) > 0) {
            foreach ($this->points as $i => $point) {
                $path .= ($i == 0 ? 'M' : ' L') . "{$point[0]} {$point[1]}";
            }

            $path .= ' Z';
        }

        $attr = $this->attributes;
        $attr['d'] = $path;

        return $this->writeTag('path', $attr);
    }
}
