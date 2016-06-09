<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractTag;
use Fluoresce\Svg\ElementInterface;

/**
 * Group
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Group extends AbstractTag implements ElementInterface
{
    /**
     * @var array Elements
     */
    private $elements = [];

    /**
     * @param ElementInterface $element
     *
     * @return Group
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
