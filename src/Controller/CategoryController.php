<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgrammeRepository;
use App\Form\CategoryType;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/category', name: 'category_')]
Class CategoryController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response

    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [

            'categories' => $categories,

        ]);

    }

    #[Route('/new', name: 'new')]

    public function new(Request $request, EntityManagerInterface $entityManager) : Response

    {

        // Create a new Category Object

        $category = new Category();

        // Create the associated Form

        $form = $this->createForm(CategoryType::class, $category);

        // Get data from HTTP request

        $form->handleRequest($request);

        // Was the form submitted ?

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($category);

            $entityManager->flush();


            // Redirect to categories list

            return $this->redirectToRoute('category_index');



        }

        return $this->render('category/new.html.twig', [

            'form' => $form->createView()]);

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