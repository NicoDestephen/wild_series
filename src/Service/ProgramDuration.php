<?php

namespace App\Service;

use App\DataFixtures\ProgramFixtures;
use App\Entity\Program;

class ProgramDuration 
{
    public function calculate(Program $program): string
    {
        $totalDuration = 0;
        foreach ($program->getSeasons() as $key => $season) {
            foreach ($season->getEpisodes() as $key => $episode) {
                $totalDuration += $episode->getDuration();
            }
        }
        return $totalDuration;
    } 
}