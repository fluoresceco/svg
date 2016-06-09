<?php

namespace Fluoresce\Svg\Definition;

use Fluoresce\Svg\AbstractTag;
use Fluoresce\Svg\DefinitionInterface;

/**
 * Radial gradient
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class RadialGradient extends AbstractTag implements DefinitionInterface
{
    /**
     * @var string Unique identifier
     */
    protected $id;

    /**
     * @var array Colour stops
     */
    protected $stops;

    /**
     * @param array|null     $center Centre point coordinates
     * @param float|int|null $radius
     */
    public function __construct()
    {
        $this->id = uniqid();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $coordinates
     *
     * @return RoundedPolygon
     */
    public function addStop($offset, $color)
    {
        // TODO Validation
        // TODO Create a color class
        $this->stops[] = ['offset' => $offset, 'color' => $color];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function write()
    {
        // TODO Check we have the necessary data set, throw an exception if not

        $attr = $this->attributes;
        $attr['id'] = $this->id;

        $contents = '';

        foreach ($this->stops as $stop) {
            $contents .= $this->writeTag('stop', ['offset' => $stop['offset'], 'stop-color' => $stop['color']]);
        }

        return $this->writeTag('radialGradient', $attr, $contents);
    }
}
