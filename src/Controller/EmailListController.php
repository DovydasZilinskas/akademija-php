<?php

namespace App\Controller;

use App\Entity\EmailList;
use Doctrine\ORM\Mapping\Id;
use App\Repository\EmailListRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
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

        $search = $request->query->all();
        $orderBy = $request->query->get('orderby', 'createdAt');
        $order = $request->query->get('order', 'DESC');
        $page = $request->query->get('page', '1');

        /**
         * @var EmailListRepository
         */
        $repo = $em->getRepository(EmailList::class);

        if (count($search) == 0) {
            $data = $repo->getAllFiltered($orderBy, $order);
        } else {
            $data = $repo->getSearchValues($search, $orderBy, $order);
        }

        $pageSize = 10;
        $paginator = new Paginator($data);
        $totalItems = count($paginator);
        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page-1))
            ->setMaxResults($pageSize);

        $paginated = $serializerInterface->serialize($paginator, 'json');

        return new Response($paginated, 200, ['Content-Type' => 'application/json', 'totalItems' => $totalItems]);
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
