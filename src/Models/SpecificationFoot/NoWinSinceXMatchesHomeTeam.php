<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseNoResultSinceXMatches;

class NoWinSinceXMatchesHomeTeam extends BaseNoResultSinceXMatches
{
    const NAME = "No_W_SinceX_H";

    protected $typeTeam = 'position_home_team';

    protected $typeResult = 'W';
}
