<?php

namespace App\Controller;

use App\Entity\TouristGroup;
use App\Form\TouristGroupType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class TouristGroupController extends Controller
{
    /**
     * @Route("/tourist_group", name="tourist_group")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->findAll();

        return $this->render('tourist_group/index.html.twig', array('tourist_group' => $tourist_group));
    }

    /**
     * @Route("/tourist_group/new", name="new_tourist_group")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function new(Request $request)
    {
        $new_tourist_group = new TouristGroup();

        $tourist_group = $this->createForm(TouristGroupType::class, $new_tourist_group);

        $tourist_group->offsetUnset('numberOfChildPersons');
        $tourist_group->offsetUnset('incomeServicesPaymentPerPerson');
        $tourist_group->offsetUnset('expenseMeeting');
        $tourist_group->offsetUnset('expenseSeeingOff');
        $tourist_group->offsetUnset('expenseTransport');
        $tourist_group->offsetUnset('expenseTicketsPerPerson');
        $tourist_group->offsetUnset('expenseEcoDuesPerPerson');
        $tourist_group->offsetUnset('expenseBoatPerAdultPerson');
        $tourist_group->offsetUnset('expenseBread');
        $tourist_group->offsetUnset('expenseTicketsNumberOfPersons');
        $tourist_group->offsetUnset('expenseEcoDuesNumberOfPersons');
        $tourist_group->offsetUnset('expenseBoatNumberOfPersons');
        $tourist_group->offsetUnset('incomeServicesPaymentNumberOfPersons');
        $tourist_group->offsetUnset('expenseTicketsTotal');
        $tourist_group->offsetUnset('expenseEcoDuesTotal');
        $tourist_group->offsetUnset('expenseBoatTotal');
        $tourist_group->offsetUnset('incomeServicesPaymentTotal');
        $tourist_group->offsetUnset('expenseArMuseumTotal');
        $tourist_group->offsetUnset('expenseTuriyRogTotal');
        $tourist_group->offsetUnset('expenseArMuseumNumberOfPersons');
        $tourist_group->offsetUnset('expenseTuriyRogNumberOfPersons');
        $tourist_group->offsetUnset('expenseArMuseumPerPerson');
        $tourist_group->offsetUnset('expenseTuriyRogPerPerson');
        $tourist_group->offsetUnset('status');

        $tourist_group->handleRequest($request);

        if ($tourist_group->isSubmitted() and $tourist_group->isValid()) {
            $new_tourist_group->setStatus('newGroup');
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_tourist_group);
            $em->flush();

            $id = $new_tourist_group->getId();

            return $this->redirectToRoute('tourist_group_show', array('id' => $id));
        }

        return $this->render('tourist_group/new.html.twig', array(
            'tourist_group' => $tourist_group->createView()
        ));
    }

    /**
     * @Route("/tourist_group/edit/{id}", name="edit_tourist_group")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function edit(Request $request, $id)
    {
        $edit_tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->find($id);

        $tourist_group = $this->createForm(TouristGroupType::class, $edit_tourist_group);

        $tourist_group->offsetUnset('notifyGuide');
        $tourist_group->offsetUnset('incomeServicesPaymentPerPerson');
        $tourist_group->offsetUnset('expenseMeeting');
        $tourist_group->offsetUnset('expenseSeeingOff');
        $tourist_group->offsetUnset('expenseTransport');
        $tourist_group->offsetUnset('expenseTicketsPerPerson');
        $tourist_group->offsetUnset('expenseEcoDuesPerPerson');
        $tourist_group->offsetUnset('expenseBoatPerAdultPerson');
        $tourist_group->offsetUnset('expenseBread');
        $tourist_group->offsetUnset('expenseTicketsNumberOfPersons');
        $tourist_group->offsetUnset('expenseEcoDuesNumberOfPersons');
        $tourist_group->offsetUnset('expenseBoatNumberOfPersons');
        $tourist_group->offsetUnset('incomeServicesPaymentNumberOfPersons');
        $tourist_group->offsetUnset('expenseTicketsTotal');
        $tourist_group->offsetUnset('expenseEcoDuesTotal');
        $tourist_group->offsetUnset('expenseBoatTotal');
        $tourist_group->offsetUnset('incomeServicesPaymentTotal');
        $tourist_group->offsetUnset('expenseArMuseumTotal');
        $tourist_group->offsetUnset('expenseTuriyRogTotal');
        $tourist_group->offsetUnset('expenseArMuseumNumberOfPersons');
        $tourist_group->offsetUnset('expenseTuriyRogNumberOfPersons');
        $tourist_group->offsetUnset('expenseArMuseumPerPerson');
        $tourist_group->offsetUnset('expenseTuriyRogPerPerson');

        $tourist_group->handleRequest($request);

        if ($tourist_group->isSubmitted() and $tourist_group->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('tourist_group_show', array('id' => $id));
        }

        return $this->render('tourist_group/edit.html.twig', array(
            'tourist_group' => $tourist_group->createView()
        ));
    }

    /**
     * @Route("/tourist_group/{id}", name="tourist_group_show")
     */
    public function show($id)
    {
        $tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->find($id);

        return $this->render('tourist_group/show.html.twig', array('tourist_group' => $tourist_group));
    }

    /**
     * @Route("/tourist_group/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($tourist_group);
        $em->flush();

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/tourist_group/edit_incomes_and_expenses/{id}", name="edit_incomes_and_expenses")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editIncomesAndExpenses(Request $request, $id)
    {
        $edit_tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->find($id);

        $tourist_group = $this->createForm(TouristGroupType::class, $edit_tourist_group);

        $tourist_group->offsetUnset('appUser');
        $tourist_group->offsetUnset('foreignCompany');
        $tourist_group->offsetUnset('numberOfPersons');
        $tourist_group->offsetUnset('numberOfChildPersons');
        $tourist_group->offsetUnset('dateOfArrival');
        $tourist_group->offsetUnset('dateOfDeparture');
        $tourist_group->offsetUnset('note');
        $tourist_group->offsetUnset('notifyGuide');

        $tourist_group->offsetUnset('expenseTicketsTotal');
        $tourist_group->offsetUnset('expenseEcoDuesTotal');
        $tourist_group->offsetUnset('expenseBoatTotal');
        $tourist_group->offsetUnset('expenseArMuseumTotal');
        $tourist_group->offsetUnset('expenseTuriyRogTotal');
        $tourist_group->offsetUnset('incomeServicesPaymentTotal');
        $tourist_group->offsetUnset('status');


        if($tourist_group->get('incomeServicesPaymentNumberOfPersons')->getData() == 0){
            $tourist_group->get('incomeServicesPaymentNumberOfPersons')->setData($edit_tourist_group->getNumberOfPersons());
        }
        if($tourist_group->get('expenseTicketsNumberOfPersons')->getData() == 0){
            $tourist_group->get('expenseTicketsNumberOfPersons')->setData($edit_tourist_group->getNumberOfPersons() + 1);
        }
        if($tourist_group->get('expenseEcoDuesNumberOfPersons')->getData() == 0){
            $tourist_group->get('expenseEcoDuesNumberOfPersons')->setData($edit_tourist_group->getNumberOfPersons());
        }
        if($tourist_group->get('expenseBoatNumberOfPersons')->getData() == 0){
            $tourist_group->get('expenseBoatNumberOfPersons')->setData($edit_tourist_group->getNumberOfPersons() - $edit_tourist_group->getNumberOfChildPersons());
        }

        $tourist_group->handleRequest($request);

        if ($tourist_group->isSubmitted() and $tourist_group->isValid()) {
            $ett = $tourist_group->get('expenseTicketsPerPerson')->getData() * $tourist_group->get('expenseTicketsNumberOfPersons')->getData();
            $edt = $tourist_group->get('expenseEcoDuesPerPerson')->getData() * $tourist_group->get('expenseEcoDuesNumberOfPersons')->getData();
            $ebt = $tourist_group->get('expenseBoatPerAdultPerson')->getData() * $tourist_group->get('expenseBoatNumberOfPersons')->getData();
            $eam = $tourist_group->get('expenseArMuseumPerPerson')->getData() * $tourist_group->get('expenseArMuseumNumberOfPersons')->getData();
            $etr = $tourist_group->get('expenseTuriyRogPerPerson')->getData() * $tourist_group->get('expenseTuriyRogNumberOfPersons')->getData();
            $isp = $tourist_group->get('incomeServicesPaymentPerPerson')->getData() * $tourist_group->get('incomeServicesPaymentNumberOfPersons')->getData();

            $edit_tourist_group->setExpenseTicketsTotal($ett);
            $edit_tourist_group->setExpenseEcoDuesTotal($edt);
            $edit_tourist_group->setExpenseBoatTotal($ebt);
            $edit_tourist_group->setExpenseArMuseumTotal($eam);
            $edit_tourist_group->setExpenseTuriyRogTotal($etr);
            $edit_tourist_group->setIncomeServicesPaymentTotal($isp);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('tourist_group_show', array('id' => $id));
        }

        return $this->render('tourist_group/edit_incomes_and_expenses.html.twig', array(
            'tourist_group' => $tourist_group->createView()
        ));
    }

    /**
     * @Route("/tourist_group/change_status/{id}")
     * @Method({"GET", "POST"})
     */
    public function changeStatus($id)
    {
        $tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->find($id);

        if ($tourist_group->getStatus() === 'newGroup') {
            $tourist_group->setStatus('approveRequest');
        } elseif ($tourist_group->getStatus() === 'approveRequest') {
            $tourist_group->setStatus('reportApproved');
        } elseif ($tourist_group->getStatus() === 'reportApproved') {
            $tourist_group->setStatus('archived');
        }


        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('tourist_group_show', array('id' => $id));
    }
}


