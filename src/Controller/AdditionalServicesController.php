<?php

namespace App\Controller;

use App\Entity\AdditionalServices;
use App\Form\AdditionalServicesType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdditionalServicesController extends Controller
{
    /**
     * @Route("/additional_services", name="additionalServices")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $servicesSupplier = $this->getDoctrine()->getRepository(AdditionalServices::class)->findAll();

        return $this->render('additional_services/index.html.twig', array('servicesSupplier' => $servicesSupplier));
    }

    /**
     * @Route("/additional_services/new", name="newAdditionalServices")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $tg = $request->query->get('tourist_group');
        $repo = $this->getDoctrine()->getRepository('App:TouristGroup');
        $found = $repo->find($tg);

        $new_additional_services = new AdditionalServices();

        $additional_services = $this->createForm(AdditionalServicesType::class, $new_additional_services);

        $additional_services->offsetUnset('touristGroup');
        $additional_services->offsetUnset('guideCommissionValue');
        $additional_services->offsetUnset('companyCommissionValue');
        $additional_services->offsetUnset('costPrice');
        $additional_services->offsetUnset('incomeValue');

        $additional_services->handleRequest($request);

        if ($additional_services->isSubmitted() and $additional_services->isValid())
        {
            $costPrice = $additional_services->get('numberOfPersons')->getData() * $new_additional_services->getServicesSupplier()->getCostPerPerson();
            $new_additional_services->setCostPrice($costPrice);

            $incomeValue = $additional_services->get('numberOfPersons')->getData() * $new_additional_services->getServicesSupplier()->getCostForClient();
            $new_additional_services->setIncomeValue($incomeValue);

            $gCom = ($incomeValue - $costPrice) * $new_additional_services->getServicesSupplier()->getGuideCommissionPct();
            $new_additional_services->setGuideCommissionValue($gCom);

            $cCom = $incomeValue - $costPrice - $gCom;
            $new_additional_services->setCompanyCommissionValue($cCom);

            $new_additional_services->setTouristGroup($found);
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_additional_services);
            $em->flush();

            if ($additional_services->getClickedButton()->getName() === 'save_and_add') {
                return $this->redirect('/additional_services/new?tourist_group='.$tg);
            }

            if ($additional_services->getClickedButton()->getName() === 'save') {
                return $this->redirectToRoute('tourist_group_show', array('id' => $tg));
            }
        }

        return $this->render('additional_services/new.html.twig', array (
            'additional_services' => $additional_services->createView()
        ));

    }

    /**
     * @Route("/additional_services/edit/{id}", name="editAdditionalServices")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $tg = $request->query->get('tourist_group');

        $edit_additional_services = $this->getDoctrine()->getRepository(AdditionalServices::class)->find($id);

        $additional_services = $this->createForm(AdditionalServicesType::class, $edit_additional_services);

        $additional_services->offsetUnset('touristGroup');
        $additional_services->offsetUnset('save_and_add');

        if ($this->getUser()->getRole() === 'ROLE_GUIDE') {
            $additional_services->offsetUnset('guideCommissionValue');
            $additional_services->offsetUnset('companyCommissionValue');
            $additional_services->offsetUnset('costPrice');
            $additional_services->offsetUnset('incomeValue');
        }

        $additional_services->handleRequest($request);

        if ($additional_services->isSubmitted() and $additional_services->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('tourist_group_show', array('id' => $tg));
        }

        return $this->render('additional_services/edit.html.twig', array (
            'additional_services' => $additional_services->createView()
        ));

    }

    /**
     * @Route("/additional_services/{id}", name="additionalServicesShow")
     */
    public function show($id)
    {
        $additional_services = $this->getDoctrine()->getRepository(AdditionalServices::class)->find($id);

        return $this->render('additional_services/show.html.twig', array ('additional_services'=>$additional_services));
    }




    /**
     * @Route("/additional_services/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $additional_services = $this->getDoctrine()->getRepository(AdditionalServices::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($additional_services);
        $em->flush();

        $response = new Response();
        $response->send();

    }
}
