<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseTeamHasNeverXAtHome;

class HomeTeamHasNeverWinAtHome extends BaseTeamHasNeverXAtHome
{
    protected $typeTeam = 'position_home_team';

    protected $typeResult = 'win';
}
