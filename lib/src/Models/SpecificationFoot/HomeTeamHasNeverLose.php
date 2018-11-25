<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseTeamHasNeverX;

class HomeTeamHasNeverLose extends BaseTeamHasNeverX
{
    protected $typeTeam = "position_home_team";

    protected $typeResult = "lost";
}
