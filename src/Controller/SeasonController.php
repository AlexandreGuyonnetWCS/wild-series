<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\SeasonRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class SeasonController extends AbstractController
{
    #[Route('/season', name: 'season_index')]
    public function index(SeasonRepository $seasonRepository): Response
    {
         $seasons = $seasonRepository->findAll();

         return $this->render('season/index.html.twig',
             ['seasons' => $seasons]
         );
    }



    #[Route('/season/{id}', methods: ['GET'], name: 'season_show', requirements: ['id'=>'\d+'])]
            public function show(int $id, SeasonRepository $seasonRepository): Response
        {
            $season = $seasonRepository->findOneBy(['id' => $id]);
    // same as $program = $programRepository->find($id);

    if (!$season) {
        throw $this->createNotFoundException(
            'No season with id : '.$id.' found in season\'s table.'
        );
    }
    return $this->render('season/show.html.twig', [
        'season' => $season,
    ]);
        }
}


