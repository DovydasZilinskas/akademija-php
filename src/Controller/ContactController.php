<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Model\ContactModel;
use App\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    #[Route("/contact", name: "contact")]
    
    public function index(Request $request, ContactService $contactService)
    {
        $contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactService->sendMessage($contact);

            $this->addFlash('success', 'Your message has been sent');

            return $this->redirectToRoute('user_profile_index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
