<?php

namespace Fluoresce\Svg;

/**
 * SVG image
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Svg extends AbstractElement
{
    /**
     * @var int Width
     */
    private $width;

    /**
     * @var int Height
     */
    private $height;

    /**
     * @var array Image elements
     */
    private $elements = [];

    /**
     * @param int|null $width
     * @param int|null $height
     */
    public function __construct($width = null, $height = null)
    {
        if ($width !== null) {
            $this->setWidth($width);
        }

        if ($height !== null) {
            $this->setHeight($height);
        }
    }

    /**
     * @param int $width
     *
     * @return Svg
     */
    public function setWidth($width)
    {
        // TODO Validate the width value
        $this->width = $width;

        return $this;
    }

    /**
     * @param int $height
     *
     * @return Svg
     */
    public function setHeight($height)
    {
        // TODO Validate the height value
        $this->height = $height;

        return $this;
    }

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
     * @return string
     */
    public function draw()
    {
        $attr['viewBox'] = "0 0 $this->width $this->height";
        $attr['xmlns'] = 'http://www.w3.org/2000/svg';

        $contents = '';

        foreach ($this->elements as $element) {
            $contents .= $element->draw();
        }

        return $this->writeTag('svg', $attr, $contents);
    }
}
