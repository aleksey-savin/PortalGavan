<?php

namespace App\Controller;

use App\Entity\TouristGroup;
use App\Form\TouristGroupType;

use App\Entity\AppUsers;
use App\Form\UserType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class MainPageController extends Controller
{
    /**
     * @Route("/", name="main_page")
     */
    public function index()
    {
        if ($this->getUser()->getRole() === 'ROLE_GUIDE') {
            $tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->findBy(array('appUser' => $this->getUser()));
        }

        if ($this->getUser()->getRole() === 'ROLE_ADMIN') {
            $tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->findAll();
        }

        return $this->render('main_page/index.html.twig', [
            'controller_name' => 'MainPageController',
            'tourist_group' => $tourist_group
        ]);
    }
}
