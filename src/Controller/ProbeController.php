<?php

namespace App\Controller;

use App\Entity\Probe;
use App\Entity\Vote;
use App\Entity\User;
use App\Form\ProbeType;
use App\Repository\ProbeRepository;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/probe')]
class ProbeController extends AbstractController
{
    #[Route('/', name: 'app_probe_index', methods: ['GET', 'POST'])]
    public function index(ProbeRepository $probeRepository): Response
    {
        return $this->render('probe/index.html.twig', [
            'probes' => $probeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_probe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProbeRepository $probeRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $probe = new Probe();
        $form = $this->createForm(ProbeType::class, $probe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $probeRepository->add($probe);
            return $this->redirectToRoute('app_probe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('probe/new.html.twig', [
            'probe' => $probe,
            'form' => $form,
        ]);
    }

    #[Route('/vote', name: 'app_probe_vote', methods: ['GET', 'POST'])]
    public function vote(VoteRepository $voteRepository, Request $request): Response
    {
        $vote = new Vote();
        $answer = $request->get('chosen_answer');
        $question = (int)$request->get('question_id');
        $user = (int)$request->get('user_id');
        $vote->setChosenAnswer($answer);
        $vote->setQuestionId($question);
        $vote->setUserId($user);
        $voteRepository->add($vote);
        return $this->redirectToRoute('app_probe_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/edit', name: 'app_probe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Probe $probe, ProbeRepository $probeRepository): Response
    {
        $form = $this->createForm(ProbeType::class, $probe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $probeRepository->add($probe);
            return $this->redirectToRoute('app_probe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('probe/edit.html.twig', [
            'probe' => $probe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_probe_delete', methods: ['POST'])]
    public function delete(Request $request, Probe $probe, ProbeRepository $probeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$probe->getId(), $request->request->get('_token'))) {
            $probeRepository->remove($probe);
        }

        return $this->redirectToRoute('app_probe_index', [], Response::HTTP_SEE_OTHER);
    }
}
