<?php

namespace App\Controller;



use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgrammeRepository;
use App\Form\ProgrammeType;
use App\Entity\Programme;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

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

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProgrammeRepository $programmeRepository, EntityManagerInterface $entityManager): Response

    {

        $programme = new Programme();
        $form = $this->createForm(ProgrammeType::class, $programme);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($programme);

            $entityManager->flush();
            $this->addFlash('success', 'The new series has been added!');


            // Redirect to categories list

            return $this->redirectToRoute('index');


        }

        return $this->render('program/new.html.twig', [

            'form' => $form->createView()]);

    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show(int $id, ProgrammeRepository $programmeRepository, SeasonRepository $seasonRepository): Response
    {
        $programme = $programmeRepository->findOneBy(['id' => $id]);


        if (!$programme) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in programme\'s table.'
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
