<?php

namespace App\Controller;

use App\CustomEvent\ContactEvent;
use App\Form\ContactType;
use App\Model\ContactModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ContactController extends AbstractController
{

    #[Route("/contact", name: "contact")]
    
    public function index(Request $request, EventDispatcherInterface $dispatcher)
    {
            
        $contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new ContactEvent($contact);

            $dispatcher->dispatch($event, ContactEvent::NAME);

            $this->addFlash('success', 'Your message has been sent');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
