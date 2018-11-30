<?php

namespace Generator\Models\ContextGenerator\Many;

use Generator\Models\ContextGenerator\Base\BaseManyContextGenerator;

class BeginMatch extends BaseManyContextGenerator {

    protected $contexts = [
        "\Generator\Models\ContextGenerator\BeginReverseMatchEasy",
        "\Generator\Models\ContextGenerator\BeginReverseMatch",
        "\Generator\Models\ContextGenerator\BeginMatch",
    ];

}