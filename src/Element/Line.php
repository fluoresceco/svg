<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractTag;
use Fluoresce\Svg\ElementInterface;

/**
 * Line
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Line extends AbstractTag implements ElementInterface
{
    /**
     * @var array Start coordinates
     */
    private $start;

    /**
     * @var array End coordinates
     */
    private $end;

    /**
     * @param array|null $start
     * @param array|null $end
     */
    public function __construct($start = null, $end = null)
    {
        if ($start !== null) {
            $this->setStart($start);
        }

        if ($end !== null) {
            $this->setEnd($end);
        }
    }

    /**
     * @param array $coordinates
     *
     * @return Circle
     */
    public function setStart($coordinates)
    {
        $this->validateCoordinates($coordinates);
        $this->start = $coordinates;

        return $this;
    }

    /**
     * @param array $coordinates
     *
     * @return Circle
     */
    public function setEnd($coordinates)
    {
        $this->validateCoordinates($coordinates);
        $this->end = $coordinates;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function draw()
    {
        // TODO Check we have the necessary data set, throw an exception if not

        $attr = $this->attributes;

        $attr['x1'] = $this->start[0];
        $attr['y1'] = $this->start[1];
        $attr['x2'] = $this->end[0];
        $attr['y2'] = $this->end[1];
        // TODO fill, stroke, stroke-width

        return $this->writeTag('line', $attr);
    }
}
