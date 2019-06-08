<?php

namespace Generator\Models\ContextGenerator\Many;

use Generator\Models\ContextGenerator\Base\ManyContextGenerator;

class BeginMatch extends ManyContextGenerator
{
    protected $contexts = [
        "\Generator\Models\ContextGenerator\BeginReverseMatchEasy",
        "\Generator\Models\ContextGenerator\BeginReverseMatch",
        "\Generator\Models\ContextGenerator\BeginMatch",
    ];
}
