<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseTeamHasNeverX;

class HomeTeamHasNeverDraw extends BaseTeamHasNeverX
{
    protected $typeTeam = 'position_home_team';

    protected $typeResult = 'draw';
}
