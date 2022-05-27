<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\EpisodeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class EpisodeController extends AbstractController
{
    #[Route('/episode', name: 'episode_index')]
    public function index(EpisodeRepository $episodeRepository): Response
    {
         $episodes = $episodeRepository->findAll();

         return $this->render('episode/index.html.twig',
             ['episodes' => $episodes]
         );
    }



    #[Route('/episode/{id}', methods: ['GET'], name: 'episode_show', requirements: ['id'=>'\d+'])]
            public function show(int $id, EpisodeRepository $episodeRepository): Response
        {
            $episode = $episodeRepository->findOneBy(['id' => $id]);
    

    if (!$episode) {
        throw $this->createNotFoundException(
            'No episode with id : '.$id.' found in episode\'s table.'
        );
    }
    return $this->render('episode/show.html.twig', [
        'episode' => $episode,
    ]);
        }
}


