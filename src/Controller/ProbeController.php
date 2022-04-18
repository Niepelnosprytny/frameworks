<?php

namespace App\Controller;

use App\Entity\Probe;
use App\Entity\Vote;
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
    public function index(ProbeRepository $probeRepository, VoteRepository $voteRepository): Response
    {
        $disabledProbes = $probeRepository->findAllDisabledProbes();

        if($this->getUser()){
            $disallowedProbes = array();
            $userId = $this->getUser()->getId();
            $roles = $this->getUser()->getRoles();
            $alreadyVoted = $probeRepository->findAllAlreadyVotedByUserProbes($userId);

            for($i = 0; $i < count($alreadyVoted); $i++){
                $disallowedProbes[$i] = $alreadyVoted[$i]['id'];
            }

            for($j = 0; $j < count($disabledProbes); $j++){
                if(in_array($disabledProbes[$j]['id'], $disallowedProbes) == false){
                    array_push($disallowedProbes, $disabledProbes[$j]['id']);
                }
            }

            for($k = 0; $k < count($probeRepository->findAll()); $k++){
                $array[$k] = $k;
            }

            $array = array_diff($array, $disallowedProbes);
            $array = array_values($array);

            if(array_key_exists(0, $array) && array_key_exists(1, $array)) {
                $number = array_rand($array);
            } else {
                $number = -1;
            }
        } else {
            $roles = [];
            $number = random_int(1, count($probeRepository->findAll())) - 1;
        }

        $votesPerProbe = array();
        $usersPerProbe = array();
        if(in_array('ROLE_ADMIN', $roles)){
            for($j = 0; $j <= count($probeRepository->findAll()); $j++){
                for($i = 0; $i <= 2; $i++){
                    $votesValue = $voteRepository->findAllVotesPerAnswer($j, $i + 1)[0][0];
                    $votesPerProbe[$j][$i] = $votesValue;
                }

                $userValue = $voteRepository->findAllUsersPerProbe($j);
                $usersPerProbe[$j] = $userValue;
            }

            return $this->render('probe/admin.html.twig', [
                'probes' => $probeRepository->findAll(),
                'votes' => $voteRepository->findAll(),
                'votesPerProbe' => $votesPerProbe,
                'usersPerProbe' => $usersPerProbe,
            ]);
        } else {
            for($i = 0; $i <= 2; $i++){
                $value = $voteRepository->findAllVotesPerAnswer($number, $i + 1)[0][0];
                $votesPerProbe[$i] = $value;
            }

            return $this->render('probe/index.html.twig', [
                'probes' => $probeRepository->findAll(),
                'votes' => $voteRepository->findAll(),
                'votesPerProbe' => $votesPerProbe,
                'number' => $number,
            ]);
        }
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

    #[Route('/vote', name: 'app_probe_vote', methods: ['POST'])]
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

    #[Route('/enabled', name: 'app_probe_enabled', methods: ['POST'])]
    public function enabled(ProbeRepository $probeRepository, Request $request): Response
    {
        $probeId = $request->get('id');
        $enabled = $request->get('enabled');

        $probe = $probeRepository->find($probeId);

        if($enabled == true){
            $probe->setEnabled(false);
        } else {
            $probe->setEnabled(true);
        }

        $probeRepository->add($probe);
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
