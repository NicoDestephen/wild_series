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
        $days = floor($totalDuration / 60 / 24);
        $hours = floor(($totalDuration - $days * 24 * 60) / 60);
        $minutes = $totalDuration - ($days * 24 * 60) - ($hours * 60);
        return $days . " jours " . $hours . " heures " . $minutes . " minutes";
    } 
}
