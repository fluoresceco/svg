<?php

namespace Fluoresce\Svg\Tests\Definition;

use Fluoresce\Svg\Definition\RadialGradient;
use Fluoresce\Svg\Element\Circle;
use Fluoresce\Svg\Tests\AbstractTestCase;

class RadialGradientTest extends AbstractTestCase
{
    public function testOutput()
    {
        $imagePath = 'radial-gradient.svg';

        $gradient = new RadialGradient();
        $gradient
            ->addStop('0%', '#4f7cd3')
            ->addStop('50%', '#f6f9ff')
            ->addStop('50%', '#504463')
            ->addStop('90%', '#fff')
            ->addStop('100%', '#c7c9db')
        ;

        $circle = new Circle([50, 50], 30);
        $circle->setAttributes([
            'fill' => 'url(#' . $gradient->getId() . ')',
            'stroke' => 'blue',
            'stroke-width' => '4',
        ]);

        $image = $this->createImage();
        $image->addDefinition($gradient);
        $image->addElement($circle);

        $this->assertEquals(
            $this->compareImageToBaseline($image, $imagePath),
            0,
            "More than 0 pixels in image '$imagePath' did not match the baseline version"
        );
    }
}
