<?php

namespace Interlink\Renderer;

use InvalidArgumentException;

class HyperlinkRenderer implements RendererInterface
{
    private $target;
    
    public function setTarget($target)
    {
        $this->target = $target;
    }
    
    public function render($url, $label)
    {
        $html = '<a href="' . $url . '"';
        if ($this->target) {
            $html .= ' target="' . $this->target . '"';
        }
        $html .= '>' . $label . '</a>';
        return $html;
    }
}
