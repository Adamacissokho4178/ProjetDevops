<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    private $entityManager;
    private $coursRepository;

    public function __construct(EntityManagerInterface $entityManager, CoursRepository $coursRepository)
    {
        $this->entityManager = $entityManager;
        $this->coursRepository = $coursRepository;
    }

    /**
     * @Route("/cours", name="cours_index")
     */
    public function index(): Response
    {
        // Affiche tous les cours
        $cours = $this->coursRepository->findAll();

        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
        ]);
    }

    /**
     * @Route("/cours/ajouter", name="cours_ajouter")
     */
    public function ajouter(Request $request): Response
    {
        $cours = new Cours();

        $form = $this->createFormBuilder($cours)
            ->add('nomCours')
            ->add('codeCours')
            ->add('nbHeures')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($cours);
            $this->entityManager->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cours/modifier/{id}", name="cours_modifier")
     */
    public function modifier(int $id, Request $request): Response
    {
        $cours = $this->coursRepository->find($id);

        if (!$cours) {
            throw $this->createNotFoundException('Le cours n\'existe pas.');
        }

        $form = $this->createFormBuilder($cours)
            ->add('nomCours')
            ->add('codeCours')
            ->add('nbHeures')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/modifier.html.twig', [
            'form' => $form->createView(),
            'cours' => $cours,
        ]);
    }

    /**
     * @Route("/cours/supprimer/{id}", name="cours_supprimer")
     */
    public function supprimer(int $id): Response
    {
        $cours = $this->coursRepository->find($id);

        if (!$cours) {
            throw $this->createNotFoundException('Le cours n\'existe pas.');
        }

        $this->entityManager->remove($cours);
        $this->entityManager->flush();

        return $this->redirectToRoute('cours_index');
    }
}
