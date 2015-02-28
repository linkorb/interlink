<?php

namespace Interlink\Renderer;

use InvalidArgumentException;

class ImageRenderer implements RendererInterface
{
    public function render($url, $label)
    {
        $html = '<img src="' . $url . '"';
        $html .= ' title="' . $label . '"';
        $html .= ' />';
        return $html;
    }
}
