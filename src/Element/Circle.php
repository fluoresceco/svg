<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractElement;
use Fluoresce\Svg\ElementInterface;

/**
 * Circle
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Circle extends AbstractElement implements ElementInterface
{
    /**
     * @var array Coordinates
     */
    private $coordinates;

    /**
     * @var float|int Radius
     */
    private $radius;

    /**
     * @param array|null     $coordinates
     * @param float|int|null $radius
     */
    public function __construct($coordinates = null, $radius = null)
    {
        if ($coordinates !== null) {
            $this->setCoordinates($coordinates);
        }

        if ($radius !== null) {
            $this->setRadius($radius);
        }
    }

    /**
     * @param array $coordinates
     *
     * @return Circle
     */
    public function setCoordinates($coordinates)
    {
        $this->validateCoordinates($coordinates);
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * @param float|int $radius
     *
     * @return Circle
     */
    public function setRadius($radius)
    {
        // TODO Validate the radius value
        $this->radius = $radius;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function draw()
    {
        // TODO Check we have the necessary data set, throw an exception if not

        $attr = $this->attributes;

        $attr['cx'] = $this->coordinates[0];
        $attr['cy'] = $this->coordinates[1];
        $attr['r'] = $this->radius;
        // TODO fill, stroke, stroke-width

        return $this->writeTag('circle', $attr);
    }
}
