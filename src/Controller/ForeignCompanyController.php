<?php

namespace App\Controller;

use App\Entity\ForeignCompany;
use App\Form\ForeignCompanyType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;




class ForeignCompanyController extends Controller
{
    /**
     * @Route("/foreign_company", name="foreignCompany")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $foreignCompany = $this->getDoctrine()->getRepository(foreignCompany::class)->findAll();

        return $this->render('foreign_company/index.html.twig', array('foreignCompany' => $foreignCompany));
    }

    /**
     * @Route("/foreign_company/new", name="new_foreignCompany")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function new(Request $request)
    {
        $new_foreignCompany = new foreignCompany();
        $foreignCompany = $this->createForm(foreignCompanyType::class, $new_foreignCompany);

        $foreignCompany->offsetUnset('isDeleted');

        $foreignCompany->handleRequest($request);

        if ($foreignCompany->isSubmitted() and $foreignCompany->isValid())
        {
            $new_foreignCompany->setIsDeleted(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($new_foreignCompany);
            $em->flush();

            return $this->redirectToRoute('foreignCompany');
        }

        return $this->render('foreign_company/new.html.twig', array (
            'foreignCompany' => $foreignCompany->createView()
        ));
    }

    /**
     * @Route("/foreign_company/edit/{id}", name="edit_foreignCompany")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function edit(Request $request, $id)
    {
        $edit_foreignCompany = $this->getDoctrine()->getRepository(foreignCompany::class)->find($id);

        $foreignCompany = $this->createForm(foreignCompanyType::class, $edit_foreignCompany);

        $foreignCompany->offsetUnset('isDeleted');

        $foreignCompany->handleRequest($request);

        if ($foreignCompany->isSubmitted() and $foreignCompany->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('foreignCompany');
        }

        return $this->render('foreign_company/edit.html.twig', array (
            'foreignCompany' => $foreignCompany->createView()
        ));

    }

    /**
     * @Route("/foreign_company/{id}", name="foreignCompany_show")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function show($id)
    {
        $foreignCompany = $this->getDoctrine()->getRepository(foreignCompany::class)->find($id);

        return $this->render('foreign_company/show.html.twig', array ('foreignCompany'=>$foreignCompany));
    }

    /**
     * @Route("/foreign_company/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $foreign_company = $this->getDoctrine()->getRepository(ForeignCompany::class)->find($id);

        $foreign_company->setIsDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('foreignCompany');
    }
}
