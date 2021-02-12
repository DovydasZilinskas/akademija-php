<?php

namespace App\Controller;

use App\Entity\EmailList;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailListController extends AbstractController
{
    #[Route('/emails', name: 'email_list')]
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(EmailList::class)->findAll();
    
        $pagination = $paginator->paginate(
            $repo,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('email_list/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/{id}', name: 'email_delete', methods: ['DELETE'])]
    public function delete(Request $request, EmailList $emailList): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');

        if ($this->isCsrfTokenValid('delete' . $emailList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emailList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('email_list');
    }
}
