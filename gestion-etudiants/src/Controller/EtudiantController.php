<?php

namespace App\Controller;

use App\Entity\étudiants;
use App\Repository\étudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    private $repository;
    private $entityManager;

    public function __construct(étudiantsRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    // Affichage de la liste des étudiants
    #[Route('/etudiants', name: 'etudiants_index')]
    public function index(): Response
    {
        $etudiants = $this->repository->findAll();
        return $this->render('etudiants/index.html.twig', [
            'etudiants' => $etudiants
        ]);
    }

    // Formulaire pour ajouter un étudiant
    #[Route('/etudiants/ajouter', name: 'etudiants_ajouter')]
    public function ajouter(Request $request): Response
    {
        $etudiant = new étudiants();

        if ($request->isMethod('POST')) {
            $etudiant->setNom($request->request->get('nom'))
                     ->setPrenom($request->request->get('prenom'))
                     ->setEmail($request->request->get('email'))
                     ->setFiliere($request->request->get('filiere'));

            $this->entityManager->persist($etudiant);
            $this->entityManager->flush();

            return $this->redirectToRoute('etudiants_index');
        }

        return $this->render('etudiants/ajouter.html.twig');
    }

    // Formulaire pour modifier un étudiant
    #[Route('/etudiants/modifier/{id}', name: 'etudiants_modifier')]
    public function modifier(int $id, Request $request): Response
    {
        $etudiant = $this->repository->find($id);
        
        if (!$etudiant) {
            throw $this->createNotFoundException('Étudiant non trouvé');
        }

        if ($request->isMethod('POST')) {
            $etudiant->setNom($request->request->get('nom'))
                     ->setPrenom($request->request->get('prenom'))
                     ->setEmail($request->request->get('email'))
                     ->setFiliere($request->request->get('filiere'));

            $this->entityManager->flush();

            return $this->redirectToRoute('etudiants_index');
        }

        return $this->render('etudiants/modifier.html.twig', [
            'etudiant' => $etudiant
        ]);
    }

    // Suppression d'un étudiant
    #[Route('/etudiants/supprimer/{id}', name: 'etudiants_supprimer')]
    public function supprimer(int $id): Response
    {
        $etudiant = $this->repository->find($id);

        if (!$etudiant) {
            throw $this->createNotFoundException('Étudiant non trouvé');
        }

        $this->entityManager->remove($etudiant);
        $this->entityManager->flush();

        return $this->redirectToRoute('etudiants_index');
    }
}
