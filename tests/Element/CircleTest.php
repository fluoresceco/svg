<?php

namespace Fluoresce\Svg\Tests\Element;

use Fluoresce\Svg\Element\Circle;
use Fluoresce\Svg\Tests\AbstractTestCase;

class CircleTest extends AbstractTestCase
{
    public function testOutput()
    {
        $imagePath = 'circle.svg';

        $circle = new Circle([50, 50], 30);
        $circle->setAttributes([
            'fill' => 'red',
            'stroke' => 'blue',
            'stroke-width' => '4',
        ]);

        $image = $this->createImage();
        $image->addElement($circle);

        $this->assertEquals(
            $this->compareImageToBaseline($image, $imagePath),
            0,
            "More than 0 pixels in image '$imagePath' did not match the baseline version"
        );
    }
}
