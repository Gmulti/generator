<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseNoResultSinceXMatches;

class NoDrawSinceXMatchesVisitorTeam extends BaseNoResultSinceXMatches
{
    const NAME = 'No_D_SinceX_A';

    protected $typeTeam = 'position_visitor_team';

    protected $typeResult = 'D';
}
