<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseTeamHasNeverXAtHome;

class HomeTeamHasNeverLoseAtHome extends BaseTeamHasNeverXAtHome
{
    protected $typeTeam = 'position_home_team';

    protected $typeResult = 'lost';
}
