<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseTeamHasNeverXAtHome;

class VisitorTeamHasNeverLoseAtHome extends BaseTeamHasNeverXAtHome
{
    protected $typeTeam = 'position_visitor_team';

    protected $typeResult = 'lost';
}
