<?php

namespace Fluoresce\Svg\Tests\Element;

use Fluoresce\Svg\Element\Polygon;
use Fluoresce\Svg\Tests\AbstractTestCase;

class PolygonTest extends AbstractTestCase
{
    public function testOutput()
    {
        $imagePath = 'polygon.svg';

        $polygon = new Polygon();
        $polygon
            ->addPoint([10,10])
            ->addPoint([70,13])
            ->addPoint([62,68])
            ->addPoint([50,50])
            ->addPoint([8,90])
        ;
        $polygon->setAttributes([
            'fill' => 'red',
            'stroke' => 'blue',
            'stroke-width' => '4',
        ]);

        $image = $this->createImage();
        $image->addElement($polygon);

        $this->assertEquals(
            $this->compareImageToBaseline($image, $imagePath),
            0,
            "More than 0 pixels in image '$imagePath' did not match the baseline version"
        );
    }
}
