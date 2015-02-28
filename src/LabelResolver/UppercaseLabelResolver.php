<?php

namespace Interlink\LabelResolver;

class UppercaseLabelResolver implements LabelResolverInterface
{
    public function resolve($reference)
    {
        return strtoupper($reference);
    }
}
