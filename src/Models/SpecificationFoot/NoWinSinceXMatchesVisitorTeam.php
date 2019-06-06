<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseNoResultSinceXMatches;

class NoWinSinceXMatchesVisitorTeam extends BaseNoResultSinceXMatches
{
    const NAME = 'No_W_SinceX_A';

    protected $typeTeam = 'position_visitor_team';

    protected $typeResult = 'W';
}
