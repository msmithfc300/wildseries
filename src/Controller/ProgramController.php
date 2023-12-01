<?php

namespace App\Controller;


use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgrammeRepository;

#[Route('/program', name: 'program_')]
Class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgrammeRepository $programmeRepository): Response

    {
        $programmes = $programmeRepository->findAll();

        return $this->render('program/index.html.twig', [

            'programmes' => $programmes,

        ]);

    }
    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show(int $id, ProgrammeRepository $programmeRepository, SeasonRepository $seasonRepository):Response
    {
        $programme = $programmeRepository->findOneBy(['id' => $id]);


        if (!$programme) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in programme\'s table.'
            );
        }




        return $this->render('program/show.html.twig', [
            'programme' => $programme,
        ]);
    }

    #[Route('/{programmeId}/seasons/{seasonId}', name: 'season_show')]
    public function showSeason(int $programmeId, int $seasonId, ProgrammeRepository $programmeRepository, SeasonRepository $seasonRepository): Response
    {
        $programme = $programmeRepository->findOneBy(['id' => $programmeId]);
        if (!$programme) {
            throw $this->createNotFoundException('Programme not found');
        }

        $season = $seasonRepository->findOneBy(['id' => $seasonId, 'programme' => $programme]);
        if (!$season) {
            throw $this->createNotFoundException('Season not found');
        }

        return $this->render('program/season_show.html.twig', [
            'programme' => $programme,
            'season' => $season,
        ]);

    }
}
