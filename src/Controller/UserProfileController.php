<?php

namespace App\Controller;

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

#[Route('/')]
class UserProfileController extends AbstractController
{
    #[Route('/', name: 'user_profile_index', methods: ['GET'])]
    public function index(UserProfileRepository $userProfileRepository, WorkExperienceRepository $workExperienceRepository, SchoolRepository $schoolRepository): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'user_profiles' => $userProfileRepository->findOneBy(['id' => 1]),
            'work_experiences' => $workExperienceRepository->findAll(),
            'schools' => $schoolRepository->findAll(),
        ]);
    }

    #[Route('user/profile/{id}/edit', name: 'user_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserProfile $userProfile): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');
        
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

    #[Route('user/profile/{id}', name: 'user_profile_delete', methods: ['DELETE'])]
    public function delete(Request $request, UserProfile $userProfile): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');
        
        if ($this->isCsrfTokenValid('delete' . $userProfile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userProfile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_profile_index');
    }
}
