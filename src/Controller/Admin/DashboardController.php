<?php

namespace App\Controller\Admin;

use App\Entity\School;
use App\Entity\UserProfile;
use App\Entity\WorkDuty;
use App\Entity\WorkExperience;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    
    #[Route("/admin", name: "admin")]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Insufficient access rights!');
        
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(EmailListCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Dovydas Corp.')
            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')
            // ->setTextDirection('ltr')
            ->renderContentMaximized()
            ->disableUrlSignatures()
        ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Profile'),
            MenuItem::linkToCrud('Profile', 'fa fa-user', UserProfile::class),
            MenuItem::linkToCrud('Work Experience', 'fa fa-tags', WorkExperience::class),
            MenuItem::linkToCrud('Education', 'fa fa-tags', School::class),
        ];
    }
}
