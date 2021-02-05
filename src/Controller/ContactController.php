<?php

namespace App\Controller;

use App\CustomEvent\ContactEvent;
use App\Form\ContactType;
use App\Model\ContactModel;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ContactController extends AbstractController
{
    #[Route("/contact", name: "contact")]

    public function indexView(Request $request)
    {
        return $this->render('contact/index.html.twig');
    }

    #[Route("/contactpost", name: "contact.post")]
    
    public function index(Request $request, EventDispatcherInterface $dispatcher, ReCaptcha $reCaptcha)
    {
            
        $contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $contact);

        $reCaptcha = $request->get('g-recaptcha-response', '');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $reCaptcha) {
            $event = new ContactEvent($contact);

            $dispatcher->dispatch($event, ContactEvent::NAME);

            $this->addFlash('success', 'Your message has been sent');

            return $this->redirectToRoute('contact');
        }

        if ($form->isSubmitted() && !$reCaptcha) {
            $this->addFlash('error', 'Please check reCaptcha checkbox!');
        }

        $view = $this->render('contact/form.html.twig', [
            'form' => $form->createView()
        ]);

        return $this->json([
            'form' => $view,
            'title' => 'Create a new post'
        ]);
    }
}
