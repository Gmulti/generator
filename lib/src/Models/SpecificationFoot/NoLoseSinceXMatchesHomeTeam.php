<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseNoResultSinceXMatches;

class NoLoseSinceXMatchesHomeTeam extends BaseNoResultSinceXMatches
{
    const NAME = "No_L_SinceX_H";

    protected $typeTeam = 'position_home_team';

    protected $typeResult = 'L';

}
