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
    public function index(Request $request, PaginatorInterface $paginator, SerializerInterface $serializerInterface)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        $em = $this->getDoctrine()->getManager();
        
        /**
         * @var EmailListRepository
         */
        $repo = $em->getRepository(EmailList::class);
        $count = $repo->getWithSearchQueryBuilder();

        $pagination = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        $data = $serializerInterface->serialize($repo->findAll(), 'json');

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/deleteemail/{id}', name: 'email_delete', methods: ['DELETE'])]
    public function delete(EmailList $emailList): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($emailList);
        $entityManager->flush();

        return $this->redirectToRoute('email_list');
    }
}