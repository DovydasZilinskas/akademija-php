<?php

namespace App\Controller;

use App\Entity\WorkExperience;
use App\Entity\UserProfile;
use App\Form\WorkExperienceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/work/experience')]
class WorkExperienceController extends AbstractController
{

    #[Route('/new', name: 'work_experience_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        $workExperience = new WorkExperience();
        $form = $this->createForm(WorkExperienceType::class, $workExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getDoctrine()->getRepository(UserProfile::class)->findOneBy([]);
            $workExperience->setUserProfile($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workExperience);
            $entityManager->flush();

            return $this->redirectToRoute('user_profile_index');
        }

        return $this->render('work_experience/new.html.twig', [
            'work_experience' => $workExperience,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'work_experience_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WorkExperience $workExperience): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        $form = $this->createForm(WorkExperienceType::class, $workExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_profile_index');
        }

        return $this->render('work_experience/edit.html.twig', [
            'work_experience' => $workExperience,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'work_experience_delete', methods: ['DELETE'])]
    public function delete(Request $request, WorkExperience $workExperience): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        if ($this->isCsrfTokenValid('delete' . $workExperience->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workExperience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_profile_index');
    }
}
