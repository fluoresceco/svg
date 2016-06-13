<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractTag;
use Fluoresce\Svg\ElementInterface;

/**
 * Text
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Text extends AbstractTag implements ElementInterface
{
    /**
     * @var array Position coordinates
     */
    private $position;

    /**
     * @var string Text content
     */
    private $text;

    /**
     * @param array|null  $position
     * @param string|null $text
     */
    public function __construct($position = null, $text = null)
    {
        if ($position !== null) {
            $this->setPosition($position);
        }

        if ($text !== null) {
            $this->setText($text);
        }
    }

    /**
     * @param array $coordinates
     *
     * @return Text
     */
    public function setPosition($coordinates)
    {
        $this->validateCoordinates($coordinates);
        $this->position = $coordinates;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return Text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function draw()
    {
        // TODO Check we have the necessary data set, throw an exception if not

        $attr = $this->attributes;
        $attr['x'] = $this->position[0];
        $attr['y'] = $this->position[1];

        return $this->writeTag('text', $attr, $this->text);
    }
}
