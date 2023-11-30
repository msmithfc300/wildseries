<?php

namespace App\Controller;


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
    public function show(int $id, ProgrammeRepository $programmeRepository):Response
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
}
