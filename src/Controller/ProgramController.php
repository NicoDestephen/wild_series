<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

            return $this->render('program/index.html.twig', [
                'programs' => $programs,
             ]);
    }



    #[Route('/show/{id<^[0-9]+$>}', requirements: ['id'=>'\d+'], methods: ['GET'], name: 'show')]
    public function show($id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        $seasons = $program->getSeasons();

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    #[Route('/{programId}/seasons/{seasonId}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository, ProgramRepository $programRepository, EpisodeRepository $episodeRepository): Response
    {
        $seasonId = $seasonRepository->findByProgram($programId, ['id' => 'ASC']);
        $programId = $programRepository->findOneBy(['id' => $programId]);
        $episodeId = $episodeRepository->findBySeason($seasonId, ['id' => 'ASC']);

        if (!$seasonId) {
            throw $this->createNotFoundException(
                'No season with id : '.$seasonId.' found in season\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'seasons' => $seasonId,
            'program' => $programId,
            'epidodes' => $episodeId,
        ]);
    }
}