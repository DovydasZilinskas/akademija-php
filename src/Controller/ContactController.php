<?php

namespace App\Controller;

use App\CustomEvent\ContactEvent;
use App\Form\ContactType;
use App\Model\ContactModel;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ContactController extends AbstractController
{

    #[Route("/contactpost", name: "contact.post")]
    
    public function renderForm(Request $request, EventDispatcherInterface $dispatcher, ReCaptcha $reCaptcha, SerializerInterface $serializerInterface)
    {
        $response = new JsonResponse(['data' => 123]);

        $contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $contact);

        // $reCaptcha = $request->get('g-recaptcha-response', '');

        $data = $request->request->all();

        $form->submit($data, false);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new ContactEvent($contact);

            $dispatcher->dispatch($event, ContactEvent::NAME);
            
            $response->setData(['data' => 'success']);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $formError) {
            $errors[$formError->getCause()->getPropertyPath()] = $formError->getMessage();
        }


        if (sizeof($errors)) {
            return new Response($serializerInterface->serialize($errors, 'json'), 400, ['Content-Type' => 'application/json']);
        }

        return $response;

        // if ($form->isSubmitted() && !$reCaptcha) {
        //     $this->addFlash('error', 'Please check reCaptcha checkbox!');
        // }
    }
}
