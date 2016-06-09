<?php

namespace Fluoresce\Svg\Tests\Element;

use Fluoresce\Svg\Element\Line;
use Fluoresce\Svg\Tests\AbstractTestCase;

class LineTest extends AbstractTestCase
{
    public function testOutput()
    {
        $imagePath = 'line.svg';

        $line = new Line([10, 30], [90, 70]);
        $line->setAttributes([
            'stroke' => 'blue',
            'stroke-width' => '4',
        ]);

        $image = $this->createImage();
        $image->addElement($line);

        $this->assertEquals(
            $this->compareImageToBaseline($image, $imagePath),
            0,
            "More than 0 pixels in image '$imagePath' did not match the baseline version"
        );
    }
}
