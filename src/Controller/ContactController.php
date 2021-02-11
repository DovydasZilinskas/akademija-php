<?php

namespace App\Controller;

use App\CustomEvent\ContactEvent;
use App\Form\ContactType;
use App\Model\ContactModel;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ContactController extends AbstractController
{
    #[Route("/contact", name: "contact")]

    public function index()
    {
        return $this->render('contact/index.html.twig');
    }

    #[Route("/contactpost", name: "contact.post")]
    
    public function renderForm(Request $request, EventDispatcherInterface $dispatcher, ReCaptcha $reCaptcha)
    {

        $response = new JsonResponse(['data' => 123]);

        $contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $contact);

        // $reCaptcha = $request->get('g-recaptcha-response', '');

        $data = json_decode($request->getContent(), true);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new ContactEvent($contact);

            $dispatcher->dispatch($event, ContactEvent::NAME);

            $response->setData(['data' => 'success']);

            // $this->addFlash('success', 'Your message has been sent');

            // return $this->redirectToRoute('user_profile_index');
        } else {
            $response->setData(['data' => 'error']);
        }

        return $response;

        // if ($form->isSubmitted() && !$reCaptcha) {
        //     $this->addFlash('error', 'Please check reCaptcha checkbox!');
        // }

        // return $this->render('contact/index.html.twig', [
        //     'form' => $form->createView()
        // ]);
    }
}
