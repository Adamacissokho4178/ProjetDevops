<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    private $classeRepository;
    private $entityManager;

    // Injection des dépendances dans le constructeur
    public function __construct(ClasseRepository $classeRepository, EntityManagerInterface $entityManager)
    {
        $this->classeRepository = $classeRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/afficher', name: 'afficher')]
    public function accueil(): Response
    {
        // Récupérer toutes les classes
        $classes = $this->classeRepository->findAll();
    
        // Passer les classes au template
        return $this->render('Classes/afficher.html.twig', [
            'classes' => $classes,  // Assurez-vous que cette variable est bien passée
        ]);
    }
    

    

    #[Route('/classes/modifier/{id}', name: 'classes_modifier')]
    public function modifier(Request $request, Classe $classe): Response
    {
        // Si la requête est de type POST, on modifie l'objet classe
        if ($request->isMethod('POST')) {
            // Mettre à jour les informations de la classe avec les nouvelles valeurs
            $classe->setNom($request->request->get('nom'));
            $classe->setNiveau($request->request->get('niveau'));
            $classe->setUpdatedAt(new \DateTime());

            // Sauvegarder les modifications dans la base de données
            $this->entityManager->flush();

            // Rediriger vers la liste des classes après la modification
            return $this->redirectToRoute('classes_afficher');
        }

        // Si ce n'est pas un POST, on retourne le formulaire de modification pré-rempli
        return $this->render('Classes/modifier.html.twig', [
            'classe' => $classe,
        ]);
    }

    #[Route('/classes/{id}/supprimer', name: 'classes_supprimer', methods: ['POST'])]
    public function supprimer(int $id): Response
    {
        $classe = $this->classeRepository->find($id);
        if ($classe) {
            $this->entityManager->remove($classe);
            $this->entityManager->flush();
        }
        return $this->redirectToRoute('classes_afficher');
    }
    #[Route('/classes/ajouter', name: 'classes_ajouter')]
    // Ajout du contrôleur pour gérer l'ajout d'une classe
public function ajouter(Request $request): Response
{
    // Créer une nouvelle instance de la classe
    $classe = new Classe();

    // Récupérer les données du formulaire envoyé en POST
    if ($request->isMethod('POST')) {
        $nom = $request->request->get('nom_classe'); // Utilisez le même nom que dans le formulaire
        $niveau = $request->request->get('niveau_classe'); // Utilisez le même nom que dans le formulaire
        
        // Vérifiez si les données sont valides
        if (empty($nom) || empty($niveau)) {
            // Retourner un message d'erreur si les champs sont vides
            return $this->render('Classes/ajouter.html.twig', [
                'error' => 'Les champs "Nom de la classe" et "Niveau" sont requis.',
            ]);
        }

        // Assurez-vous de passer les bonnes valeurs au setter
        $classe->setNomClasse($nom);
        $classe->setNiveau($niveau);

        // Sauvegarder la nouvelle classe dans la base de données
        $this->entityManager->persist($classe);
        $this->entityManager->flush();

        // Rediriger vers la liste des classes après l'ajout
        return $this->redirectToRoute('classes_afficher');
    }

    return $this->render('Classes/ajouter.html.twig');
}




}
