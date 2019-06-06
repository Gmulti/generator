<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\SpecificationFoot\Base\BaseIsTeamInLeague;
use Generator\Constants\Foot\Ligue1;

class IsHomeTeamInLigue1 extends BaseIsTeamInLeague
{
    protected $typeTeam = 'home_team';

    protected $ids = Ligue1::IDS_SPORTMONK;
}
