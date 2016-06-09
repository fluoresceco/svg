<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractTag;
use Fluoresce\Svg\ElementInterface;

/**
 * Circle
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Circle extends AbstractTag implements ElementInterface
{
    /**
     * @var array Center point coordinates
     */
    private $center;

    /**
     * @var float|int Radius
     */
    private $radius;

    /**
     * @param array|null     $center Centre point coordinates
     * @param float|int|null $radius
     */
    public function __construct($center = null, $radius = null)
    {
        if ($center !== null) {
            $this->setCenter($center);
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
    public function setCenter($coordinates)
    {
        $this->validateCoordinates($coordinates);
        $this->center = $coordinates;

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

        $attr['cx'] = $this->center[0];
        $attr['cy'] = $this->center[1];
        $attr['r'] = $this->radius;
        // TODO fill, stroke, stroke-width

        return $this->writeTag('circle', $attr);
    }
}
