<?php

namespace Fluoresce\Svg\Tests;

use Fluoresce\Svg\Svg;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    const BASELINE_IMAGE_PATH = __DIR__ . '/Fixtures/baseline-images';
    const COMPARISON_IMAGE_PATH = __DIR__ . '/Fixtures/comparison-images';

    /**
     * @param int $width
     * @param int $height
     *
     * @return Svg
     */
    protected function createImage($width = 100, $height = 100)
    {
        return new Svg($width, $height);
    }

    /**
     * @param Svg    $image    Image to compare
     * @param string $baseline Baseline image filename
     *
     * @return int Number of pixels different between the image and the baseline
     */
    protected function compareImageToBaseline(Svg $image, $baseline)
    {
        $baselinePath = self::BASELINE_IMAGE_PATH . '/' . $baseline;
        $comparisonImage = self::COMPARISON_IMAGE_PATH . '/' . $baseline;

        // Save the SVG to a file
        file_put_contents($comparisonImage, $svg = $image->draw());

        $output = 'output.txt'; // TODO Replace with a temporary file that gets cleaned up
        $cmd = "compare -dissimilarity-threshold 1 -metric AE $baselinePath $comparisonImage $output";
        $pixelsChanged = shell_exec($cmd);

        return (int) $pixelsChanged;
    }
}
