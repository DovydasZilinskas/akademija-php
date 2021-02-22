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
    
    public function renderForm(Request $request, EventDispatcherInterface $dispatcher, SerializerInterface $serializerInterface)
    {
        $response = new JsonResponse(['data' => 'response']);

        $contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $contact);

        $data = $request->request->all();

        $form->submit($data, false);

        $recaptcha = $request->request->get('captcha', null, true);

        if ($form->isSubmitted() && $form->isValid() && $recaptcha) {
            $event = new ContactEvent($contact);

            $dispatcher->dispatch($event, ContactEvent::NAME);
            
            $response->setData(['data' => 'success']);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $formError) {
            $errors[$formError->getCause() ? $formError->getCause()->getPropertyPath() : 'some error'] = $formError->getMessage();
        }

        if (sizeof($errors)) {
            return new Response($serializerInterface->serialize($errors, 'json'), 400, ['Content-Type' => 'application/json']);
        }

        return $response;
    }
}
