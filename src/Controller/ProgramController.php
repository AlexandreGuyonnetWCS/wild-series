<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProgramController extends AbstractController
{
   

    #[Route('/program', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
    

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs,
            ]
        );
    }

    #[Route('/program/new', name: 'program_new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $programRepository->add($program, true);

            // Redirect to categories list
            return $this->redirectToRoute('program_index');
        }

        // Render the form
        return $this->renderForm('/program/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/program/{id}', methods: ['GET'], name: 'program_show', requirements: ['id' => '\d+'])]
    public function show(int $id, ProgramRepository $programRepository , SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        $seasons = $seasonRepository->findBy(['program' => $program]);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }
        return $this->render('/program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }
}