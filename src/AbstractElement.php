<?php

namespace Fluoresce\Svg;

/**
 * Abstract element
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
abstract class AbstractElement
{
    /**
     * @var array Attributes
     */
    protected $attributes = [];

    /**
     * @param array $attributes
     *
     * @return AbstractElement
     */
    protected function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param string $attribute
     * @param string $value
     *
     * @return AbstractElement
     */
    protected function setAttribute($attribute, $value)
    {
        $this->attribute[$attribute] = $value;

        return $this;
    }

    /**
     * @param array $coordinates
     */
    protected function validateCoordinates($coordinates)
    {
        // TODO Also test both array elements are numeric
        if (is_array($coordinates) && count($coordinates) == 2) {
            return;
        }

        throw new InvalidCoordinatesException('Invalid coordinates specified');
    }

    /**
     * @param mixed $value
     */
    protected function encodeAttributeValue($value)
    {
        return htmlspecialchars($value, ENT_XML1, 'UTF-8');
    }

    /**
     * @param string $tag        Tag
     * @param array  $attributes Attributes
     * @param string $contents
     *
     * @return string
     */
    protected function writeTag($tag, $attributes = [], $contents = false)
    {
        $code = "<$tag";

        foreach ($attributes as $key => $value) {
            // TODO Escape the key so it's XML safe
            $value = $this->encodeAttributeValue($value);
            $code .= " $key=\"$value\"";
        }

        if ($contents !== false && mb_strlen($contents) > 0) {
            $code .= ">$contents</$tag>"
        } else {
            $code .= ' />';
        }

        return $code;
    }
}
