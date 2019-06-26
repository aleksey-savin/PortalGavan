<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Form\PurchaseType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;


class PurchaseController extends Controller
{
    /**
     * @Route("/purchase", name="purchase")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET"})
     */
    public function index()
    {
        $purchase = $this->getDoctrine()->getRepository(purchase::class)->findAll();

        return $this->render('purchase/index.html.twig', array('purchase' => $purchase));
    }

    /**
     * @Route("/purchase/new", name="new_purchase")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request, AuthorizationCheckerInterface $authChecker)
    {
        $tg = $request->query->get('tourist_group');
        $repo = $this->getDoctrine()->getRepository('App:TouristGroup');
        $found = $repo->find($tg);

        $new_purchase = new purchase();
        $purchase = $this->createForm(PurchaseType::class, $new_purchase);

        $purchase->offsetUnset('touristGroup');
        $purchase->offsetUnset('guideCommissionValue');
        $purchase->offsetUnset('groupLeaderCommissionValue');
        $purchase->offsetUnset('companyCommissionValue');

        $purchase->handleRequest($request);

        if ($purchase->isSubmitted() and $purchase->isValid())
        {
            $new_purchase->setTouristGroup($found);
            $glCom = round($purchase->get('salesReceipt')->getData() * $new_purchase->getCommission()->getGroupLeaderCommissionPct(), 0, PHP_ROUND_HALF_EVEN);
            $new_purchase->setGroupLeaderCommissionValue($glCom);

            $gCom = round($purchase->get('salesReceipt')->getData() * $new_purchase->getCommission()->getGuideCommissionPct(), 0, PHP_ROUND_HALF_EVEN);
            $new_purchase->setGuideCommissionValue($gCom);

            $cCom = round($purchase->get('salesReceipt')->getData() * $new_purchase->getCommission()->getCompanyCommissionPct(), 0, PHP_ROUND_HALF_EVEN);
            $new_purchase->setCompanyCommissionValue($cCom);

            $em = $this->getDoctrine()->getManager();
            $em->persist($new_purchase);
            $em->flush();

            if ($purchase->getClickedButton()->getName() === 'save_and_add') {
                return $this->redirect('/purchase/new?tourist_group='.$tg);
            }

            if ($purchase->getClickedButton()->getName() === 'save') {
                return $this->redirectToRoute('tourist_group_show', array('id' => $tg));
            }

        }

        return $this->render('purchase/new.html.twig', array (
            'purchase' => $purchase->createView()
        ));
    }

    /**
     * @Route("/purchase/edit/{id}", name="edit_purchase")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function edit(Request $request, $id)
    {
        $tg = $request->query->get('tourist_group');
        $repo = $this->getDoctrine()->getRepository('App:TouristGroup');
        $found = $repo->find($tg);

        $edit_purchase = $this->getDoctrine()->getRepository(purchase::class)->find($id);

        $purchase = $this->createForm(PurchaseType::class, $edit_purchase);

        $purchase->offsetUnset('touristGroup');
        $purchase->offsetUnset('save_and_add');

        $purchase->handleRequest($request);

        if ($purchase->isSubmitted() and $purchase->isValid())
        {
            $edit_purchase->setTouristGroup($found);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('tourist_group_show', array('id' => $tg));
        }

        return $this->render('purchase/edit.html.twig', array (
            'purchase' => $purchase->createView()
        ));

    }

    /**
     * @Route("/purchase/edit_base/{id}", name="edit_base_purchase")
     * @Method({"GET", "POST"})
     */
    public function edit_base(Request $request, $id)
    {
        $tg = $request->query->get('tourist_group');
        $repo = $this->getDoctrine()->getRepository('App:TouristGroup');
        $found = $repo->find($tg);

        $edit_purchase = $this->getDoctrine()->getRepository(purchase::class)->find($id);

        $purchase = $this->createForm(PurchaseType::class, $edit_purchase);

        $purchase->offsetUnset('save_and_add');
        $purchase->offsetUnset('touristGroup');
        $purchase->offsetUnset('guideCommissionValue');
        $purchase->offsetUnset('groupLeaderCommissionValue');
        $purchase->offsetUnset('companyCommissionValue');

        $purchase->handleRequest($request);

        if ($purchase->isSubmitted() and $purchase->isValid())
        {
            $edit_purchase->setTouristGroup($found);
            $glCom = round($purchase->get('salesReceipt')->getData() * $edit_purchase->getCommission()->getGroupLeaderCommissionPct(), 0, PHP_ROUND_HALF_EVEN);
            $edit_purchase->setGroupLeaderCommissionValue($glCom);

            $gCom = round($purchase->get('salesReceipt')->getData() * $edit_purchase->getCommission()->getGuideCommissionPct(), 0, PHP_ROUND_HALF_EVEN);
            $edit_purchase->setGuideCommissionValue($gCom);

            $cCom = round($purchase->get('salesReceipt')->getData() * $edit_purchase->getCommission()->getCompanyCommissionPct(), 0, PHP_ROUND_HALF_EVEN);
            $edit_purchase->setCompanyCommissionValue($cCom);

            $em = $this->getDoctrine()->getManager();
            $em->flush();


            return $this->redirectToRoute('tourist_group_show', array('id' => $tg));
        }

        return $this->render('purchase/edit_base.html.twig', array (
            'purchase' => $purchase->createView()
        ));

    }

    /**
     * @Route("/purchase/{id}", name="purchase_show")
     */
    public function show($id)
    {
        $purchase = $this->getDoctrine()->getRepository(purchase::class)->find($id);

        return $this->render('purchase/show.html.twig', array ('purchase'=>$purchase));
    }

    /**
     * @Route("/purchase/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $purchase = $this->getDoctrine()->getRepository(purchase::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($purchase);
        $em->flush();

        $response = new Response();
        $response->send();

    }

    /**
     * @Route("/get-commissions-from-tradepoint", name="purchase_list_commissions")
     * @Method({"GET"})
     */
    public function listCommissionsOfTradePointAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $commissionsRepository = $em->getRepository("App:Commission");

        // Search the commissions that belongs to the tradepoint with the given id as GET parameter "tradePointId"
        $commissions = $commissionsRepository->createQueryBuilder("q")
            ->where("q.tradePointId = :tradePointId")
            ->setParameter("tradePointId", $request->query->get("tradePointId"))
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($commissions as $commission){
            $responseArray[] = array(
                "id" => $commission->getId(),
                "name" => $commission->getName()
            );
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }
}
