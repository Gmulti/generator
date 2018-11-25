<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseNoResultSinceXMatches;

class NoLoseSinceXMatchesVisitorTeam extends BaseNoResultSinceXMatches
{
    const NAME = "No_L_SinceX_A";

    protected $typeTeam = 'position_visitor_team';

    protected $typeResult = 'L';
}
