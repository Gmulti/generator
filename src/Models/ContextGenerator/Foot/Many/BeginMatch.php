<?php

namespace Generator\Models\ContextGenerator\Many;

use Generator\Models\ContextGenerator\ManyContext;

class BeginMatch extends ManyContext
{
    protected $contexts = [
        "\Generator\Models\ContextGenerator\BeginReverseMatchEasy",
        "\Generator\Models\ContextGenerator\BeginReverseMatch",
        "\Generator\Models\ContextGenerator\BeginMatch",
    ];
}
