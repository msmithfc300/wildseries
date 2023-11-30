<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgrammeRepository;

#[Route('/category', name: 'category_')]
Class CategoryController extends AbstractController
{
    #[Route('', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response

    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [

            'categories' => $categories,

        ]);

    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgrammeRepository $programmeRepository):Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);


        if (!$category) {
            throw $this->createNotFoundException(
                'No category with the name: '.$categoryName.' found in category table.'
            );
        }

        $programmes = $programmeRepository->findBy(
            ['category' => $category],
            ['id' => 'DESC'],
            3,
        );
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programmes' => $programmes,
        ]);
    }
}