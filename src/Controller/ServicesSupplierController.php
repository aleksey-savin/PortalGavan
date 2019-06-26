<?php

namespace App\Controller;

use App\Entity\ServicesSupplier;
use App\Form\ServicesSupplierType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ServicesSupplierController extends Controller
{
    /**
     * @Route("/services_supplier", name="servicesSupplier")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $servicesSupplier = $this->getDoctrine()->getRepository(ServicesSupplier::class)->findAll();

        return $this->render('services_supplier/index.html.twig', array('servicesSupplier' => $servicesSupplier));
    }

    /**
     * @Route("/services_supplier/new", name="newServicesSupplier")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function new(Request $request)
    {
        $new_services_supplier = new ServicesSupplier();

        $services_supplier = $this->createForm(ServicesSupplierType::class, $new_services_supplier);

        $services_supplier->offsetUnset('isDeleted');

        $services_supplier->handleRequest($request);

        if ($services_supplier->isSubmitted() and $services_supplier->isValid())
        {
            $new_services_supplier->setIsDeleted(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($new_services_supplier);
            $em->flush();

            return $this->redirectToRoute('servicesSupplier');
        }

        return $this->render('services_supplier/new.html.twig', array (
            'services_supplier' => $services_supplier->createView()
        ));

    }

    /**
     * @Route("/services_supplier/edit/{id}", name="editServicesSupplier")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function edit(Request $request, $id)
    {
        $edit_services_supplier = $this->getDoctrine()->getRepository(ServicesSupplier::class)->find($id);

        $services_supplier = $this->createForm(ServicesSupplierType::class, $edit_services_supplier);

        $services_supplier->offsetUnset('isDeleted');

        $services_supplier->handleRequest($request);

        if ($services_supplier->isSubmitted() and $services_supplier->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('servicesSupplier');
        }

        return $this->render('services_supplier/edit.html.twig', array (
            'services_supplier' => $services_supplier->createView()
        ));

    }

    /**
     * @Route("/services_supplier/{id}", name="servicesSupplierShow")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function show($id)
    {
        $services_supplier = $this->getDoctrine()->getRepository(ServicesSupplier::class)->find($id);

        return $this->render('services_supplier/show.html.twig', array ('services_supplier'=>$services_supplier));
    }




    /**
     * @Route("/services_supplier/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $services_supplier = $this->getDoctrine()->getRepository(ServicesSupplier::class)->find($id);

        $services_supplier->setIsDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('servicesSupplier');

    }
}
