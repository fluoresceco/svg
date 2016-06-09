<?php

namespace Fluoresce\Svg\Element;

/**
 * Polygon with rounded corners
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class RoundedPolygon extends Polygon
{
    /**
     * @var float|int Radius
     */
    protected $radius;

    /**
     * @param float|int $radius
     *
     * @return RoundedPolygon
     */
    public function setCornerRadius($radius)
    {
        // TODO Validate the radius value
        $this->radius = $radius;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function draw()
    {
        $path = '';

        if (count($this->points) >= 3) {
            $this->points[] = $this->points[0];
            $pointCount = count($this->points);

            foreach ($this->points as $i => $point) {
                // Skip the first point, we need the calculation from the last point to place it
                if ($i == 0) {
                    continue;
                }

                $prevPoint = $this->points[$i - 1];
                $nextPoint = ($i == $pointCount - 1) ? $this->points[1] : $this->points[$i + 1];

                // Get the start and end points of the curve by getting points toward the previous and next points
                $curveStart = $this->moveTowards($point, $prevPoint);
                $curveEnd = $this->moveTowards($point, $nextPoint);

                // Get the curve control points
                $startControl = $this->moveTowardsFraction($curveStart, $point, 0.5);
                $endControl = $this->moveTowardsFraction($point, $curveEnd, 0.5);

                // Write the line
                $path .= " L {$curveStart[0]} {$curveStart[1]}";

                // Write the curve
                $path .= " C {$startControl[0]} {$startControl[1]} {$endControl[0]} {$endControl[1]} {$curveEnd[0]} {$curveEnd[1]}";
            }

            // Add the start point
            $path = "M {$curveEnd[0]} {$curveEnd[1]}" . $path;

            // Close back to the first point
            $path .= " Z";
        }

        $attr = $this->attributes;
        $attr['d'] = $path;

        return $this->writeTag('path', $attr);
    }

    /**
     * Move a given point towards another point by the defined radius
     *
     * @param array $coordinates        Origin coordinates
     * @param array $towardsCoordinates Coordinates to shift towards
     *
     * @return array
     */
    protected function moveTowards($coordinates, $towardsCoordinates)
    {
        $width = ($towardsCoordinates[0] - $coordinates[0]);
        $height = ($towardsCoordinates[1] - $coordinates[1]);

        $distance = max(1, sqrt($width * $width + $height * $height));

        return $this->moveTowardsFraction($coordinates, $towardsCoordinates, min(1, $this->radius / $distance));
    }

    /**
     * Move a given point a fraction towards another point
     *
     * @param array $coordinates        Origin point
     * @param array $towardsCoordinates Coordinates to shift towards
     * @param float $fraction           Fraction to move by. If 1, the point will be moved all the way.
     *
     * @return array
     */
    protected function moveTowardsFraction($coordinates, $towardsCoordinates, $fraction)
    {
        return [
            $coordinates[0] + ($towardsCoordinates[0] - $coordinates[0]) * $fraction,
            $coordinates[1] + ($towardsCoordinates[1] - $coordinates[1]) * $fraction
        ];
    }
}
