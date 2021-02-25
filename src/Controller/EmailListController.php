<?php

namespace App\Controller;

use App\Entity\EmailList;
use Doctrine\ORM\Mapping\Id;
use App\Repository\EmailListRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class EmailListController extends AbstractController
{
    #[Route('/emails', name: 'email_list')]
    public function getEmails()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        return $this->render('email_list/index.html.twig');
    }

    #[Route('/getemail', name: 'get_email')]
    public function index(SerializerInterface $serializerInterface, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        $em = $this->getDoctrine()->getManager();

        $name = $request->query->get('name');
        $email = $request->query->get('email');
        $message = $request->query->get('message');
        $orderBy = $request->query->get('orderby', 'createdAt');
        $order = $request->query->get('order', 'DESC');

        /**
         * @var EmailListRepository
         */
        $repo = $em->getRepository(EmailList::class);
        
        if ($name) {
            $data = $serializerInterface->serialize($repo->getSearchName($name, $orderBy, $order), 'json');
        } elseif ($email) {
            $data = $serializerInterface->serialize($repo->getSearchEmail($email, $orderBy, $order), 'json');
        } elseif ($message) {
            $data = $serializerInterface->serialize($repo->getSearchMessage($message, $orderBy, $order), 'json');
        } else {
            $data = $serializerInterface->serialize($repo->findBy([], [$orderBy => $order]), 'json');
        }

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/deleteemail/{id}', name: 'email_delete', methods: ['DELETE'])]
    public function delete(EmailList $emailList): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($emailList);
        $entityManager->flush();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
