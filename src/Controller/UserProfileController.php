<?php

namespace App\Controller;

use App\Entity\School;
use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Repository\SchoolDutyRepository;
use App\Repository\UserProfileRepository;
use App\Repository\WorkExperienceRepository;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/profile')]
class UserProfileController extends AbstractController
{
    #[Route('/', name: 'user_profile_index', methods: ['GET'])]
    public function index(UserProfileRepository $userProfileRepository, WorkExperienceRepository $workExperienceRepository, SchoolRepository $schoolRepository, SchoolDutyRepository $schoolDutyRepository): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'user_profiles' => $userProfileRepository->findAll(),
            'work_experiences' => $workExperienceRepository->findAll(),
            'schools' => $schoolRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'user_profile_show', methods: ['GET'])]
    public function show(UserProfile $userProfile): Response
    {
        return $this->render('user_profile/show.html.twig', [
            'user_profile' => $userProfile,
        ]);
    }

    #[Route('/{id}/edit', name: 'user_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserProfile $userProfile): Response
    {
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_profile_index');
        }

        return $this->render('user_profile/edit.html.twig', [
            'user_profile' => $userProfile,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'user_profile_delete', methods: ['DELETE'])]
    public function delete(Request $request, UserProfile $userProfile): Response
    {
        if ($this->isCsrfTokenValid('delete' . $userProfile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userProfile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_profile_index');
    }
}
