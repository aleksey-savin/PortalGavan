<?php

namespace App\Controller;

use App\Entity\TradePoint;
use App\Form\TradePointType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class TradePointController extends Controller
{
    /**
     * @Route("/trade_point", name="trade_point")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $trade_point = $this->getDoctrine()->getRepository(TradePoint::class)->findAll();

        return $this->render('trade_point/index.html.twig', array('trade_point' => $trade_point));
    }

    /**
     * @Route("/trade_point/new", name="new_trade_point")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function new(Request $request)
    {
        $new_trade_point = new TradePoint();

        $trade_point = $this->createForm(TradePointType::class, $new_trade_point);

        $trade_point->offsetUnset('isDeleted');

        $trade_point->handleRequest($request);

        if ($trade_point->isSubmitted() and $trade_point->isValid())
        {
            $new_trade_point->setIsDeleted(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($new_trade_point);
            $em->flush();

            return $this->redirectToRoute('trade_point');
        }

        return $this->render('trade_point/new.html.twig', array (
            'trade_point' => $trade_point->createView()
        ));

    }

    /**
     * @Route("/trade_point/edit/{id}", name="edit_trade_point")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function edit(Request $request, $id)
    {
        $edit_trade_point = $this->getDoctrine()->getRepository(TradePoint::class)->find($id);

        $trade_point = $this->createForm(TradePointType::class, $edit_trade_point);

        $trade_point->offsetUnset('isDeleted');

        $trade_point->handleRequest($request);

        if ($trade_point->isSubmitted() and $trade_point->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('trade_point');
        }

        return $this->render('trade_point/edit.html.twig', array (
            'trade_point' => $trade_point->createView()
        ));

    }

    /**
     * @Route("/trade_point/{id}", name="trade_point_show")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function show($id)
    {
        $trade_point = $this->getDoctrine()->getRepository(TradePoint::class)->find($id);

        return $this->render('trade_point/show.html.twig', array ('trade_point'=>$trade_point));
    }




    /**
     * @Route("/trade_point/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $trade_point = $this->getDoctrine()->getRepository(TradePoint::class)->find($id);

        $trade_point->setIsDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('trade_point');

    }

    /**
     * @Route("/get-active-tradepoints", name="active_tradepoints")
     * @Method({"GET"})
     */
    public function ListActiveTradpointsAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $tradepointsRepository = $em->getRepository("App:TradePoint");

        // Search the commissions that belongs to the tradepoint with the given id as GET parameter "tradePointId"
        $tradepoints = $tradepointsRepository->createQueryBuilder("q")
            ->where("q.isDeleted = :isDeleted")
            ->setParameter("isDeleted", false)
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($tradepoints as $tradepoint){
            $responseArray[] = array(
                "id" => $tradepoint->getId(),
                "name" => $tradepoint->getName()
            );
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }



}
