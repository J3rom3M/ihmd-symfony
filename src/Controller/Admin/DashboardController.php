<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('IHMD - BACKOFFICE');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoRoute('Back to the website', 'fas fa-undo', 'app_home'),
            MenuItem::linkToDashboard('Accueil', 'fa fa-fa-home'),
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
            // links to the 'index' action of the Category CRUD controller
            MenuItem::linkToDashboard('Films', 'fa fa-list'),
            MenuItem::linkToDashboard('Commentaires', 'fas fa-tags'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class),
        ];
    }
}
