<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseTeamHasNeverXAtHome;

class VisitorTeamHasNeverWinAtHome extends BaseTeamHasNeverXAtHome
{
    protected $typeTeam = 'position_visitor_team';

    protected $typeResult = 'win';
}
