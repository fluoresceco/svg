<?php

namespace Fluoresce\Svg\Element;

use Fluoresce\Svg\AbstractTag;
use Fluoresce\Svg\ElementInterface;

/**
 * Style
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class Style extends AbstractTag implements ElementInterface
{
    /**
     * @var string CSS contents of the style tag
     */
    private $content;

    /**
     * @param string|null $content
     */
    public function __construct($content = null)
    {
        if ($content !== null) {
            $this->setContent($content);
        }
    }

    /**
     * @param string $content
     *
     * @return Style
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function draw()
    {
        // TODO Check we have the necessary data set, throw an exception if not

        return $this->writeTag('style', $this->attributes, $this->content);
    }
}
