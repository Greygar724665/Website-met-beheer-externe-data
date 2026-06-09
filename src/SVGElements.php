<?php

/**
 * Class containing SVG elements for icons and such as functions to choose a color.
 */
class SVGElements
{
    /**
     * Used for throbbers/indefinite loading circles
     * @param string|null $color Any CSS accepted color. Variables are assumed if the first 2 characters are `--`
     * @param int $width Height of the element
     * @param int $height Width of the element
     * @param string|null $class External class
     * @param string|null $extraStyling
     * @return string SVG Element
     */
    public static function getCutoutRing(?string $color = "black", int $width = 32, int $height = 32, ?string $class = null, ?string $extraStyling = null): string
    {
        $color = $color ?? 'black';
        $class = $class ?? '';
        $extraStyling = $extraStyling ?? '';

        if (str_starts_with($color, '--')) {
            $color = "var($color)";
        }

        return <<<HTML
        <svg width="{$width}" height="{$height}" style="{$extraStyling}" class="{$class}" viewBox="0 0 512 512">
            <g>
                <path fill="{$color}" d="M255.932,512C114.547,511.962,-0.038,397.316,0,255.932S114.684,-0.038,256.069,0 c96.559,0.026,184.888,54.38,228.428,140.565c7.695,15.91,1.035,35.046,-14.875,42.74c-15.501,7.497,-34.155,1.384,-42.213,-13.834 C379.625,74.81,264.15,36.808,169.488,84.592S36.824,247.851,84.608,342.513s163.259,132.664,257.921,84.88 c36.48,-18.414,66.133,-47.987,84.646,-84.417c8.018,-15.753,27.287,-22.023,43.04,-14.005c15.753,8.018,22.023,27.287,14.005,43.04l0,0 C440.706,458.077,352.373,512.244,255.932,512z"/>
            </g>
        </svg>
        HTML;



    }
}