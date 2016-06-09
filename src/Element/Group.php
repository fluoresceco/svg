<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractElement;
use Fluoresce\Svg\ElementInterface;

/**
 * Group
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Group extends AbstractElement implements ElementInterface
{
    /**
     * @var array Elements
     */
    private $elements = [];

    /**
     * @param ElementInterface $element
     *
     * @return Svg
     */
    public function addElement(ElementInterface $element)
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function draw()
    {
        $contents = '';

        foreach ($this->elements as $element) {
            $contents .= $element->draw();
        }

        return $this->writeTag('g', $this->attributes, $contents);
    }
}
