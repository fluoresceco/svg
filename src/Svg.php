<?php

namespace Fluoresce\Svg;

/**
 * SVG image
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Svg extends AbstractTag
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
     * @var array SVG definitions
     */
    private $definitions = [];

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
     * @param DefinitionInterface $definition
     *
     * @return Svg
     */
    public function addDefinition(DefinitionInterface $definition)
    {
        $this->definitions[] = $definition;

        return $this;
    }

    /**
     * @return string
     */
    public function draw()
    {
        $attr['viewBox'] = "0 0 $this->width $this->height";
        $attr['xmlns'] = 'http://www.w3.org/2000/svg';

        if (count($this->definitions)) {
            $definitionCode = '<defs>';

            foreach ($this->definitions as $definition) {
                $definitionCode .= $definition->write();
            }

            $definitionCode .= '</defs>';
        }

        $elementCode = '';

        foreach ($this->elements as $element) {
            $elementCode .= $element->draw();
        }

        $contents = $definitionCode . $elementCode;

        return $this->writeTag('svg', $attr, $contents);
    }
}
