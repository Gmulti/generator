<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseNoResultSinceXMatches;

class NoDrawSinceXMatchesHomeTeam extends BaseNoResultSinceXMatches
{
    const NAME = "No_D_SinceX_H";

    protected $typeTeam = 'position_home_team';

    protected $typeResult = 'D';
}
