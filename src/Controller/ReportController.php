<?php

namespace App\Controller;

use App\Entity\AppUsers;
use App\Entity\ForeignCompany;
use App\Entity\Purchase;
use App\Entity\TouristGroup;
use App\Entity\TradePoint;
use App\Form\ReportType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller
{
    /**
     * @Route("/report", name="report")
     */
    public function index()
    {
        $tourist_group = $this->getDoctrine()->getRepository(TouristGroup::class)->findAll();

        $form = $this->createForm(ReportType::class);

        $form->offsetUnset('save');

        return $this->render('report/touristGroups.html.twig', [
            'controller_name' => 'ReportController',
            'tourist_group' => $tourist_group,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/report_guide", name="report_guide")
     */
    public function reportGuide(Request $request)
    {
        $form = $this->createForm(ReportType::class);

        $form->handleRequest($request);

        $guide = [];
        $repository = $this->getDoctrine()->getRepository(AppUsers::class);
        if ($form->isSubmitted() and $form->isValid())
        {
            $guide = $repository->getGuidesFilteredByDate($form->get('from')->getData(), $form->get('till')->getData());
        }

        return $this->render('report/guide.html.twig', array(
            'controller_name' => 'ReportController',
            'guide' => $guide,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/report_trade_points", name="report_trade_points")
     */
    public function reportShops(Request $request)
    {
        $form = $this->createForm(ReportType::class);

        $form->handleRequest($request);

        $tradePoint = [];
        $repository = $this->getDoctrine()->getRepository(TradePoint::class);
        if ($form->isSubmitted() and $form->isValid())
        {
            $tradePoint = $repository->getTradePointsFilteredByDate($form->get('from')->getData(), $form->get('till')->getData());
        }

        return $this->render('report/tradePoint.html.twig', array(
            'controller_name' => 'ReportController',
            'tradePoint' => $tradePoint,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/report_foreign_companies", name="report_foreign_companies")
     */
    public function reportForeignCompanies(Request $request)
    {
        $form = $this->createForm(ReportType::class);

        $form->handleRequest($request);

        $foreignCompany = [];
        $repository = $this->getDoctrine()->getRepository(ForeignCompany::class);
        if ($form->isSubmitted() and $form->isValid())
        {
            $foreignCompany = $repository->getForeignCompaniesFilteredByDate($form->get('from')->getData(), $form->get('till')->getData());
        }

        return $this->render('report/foreignCompanies.html.twig', array(
            'controller_name' => 'ReportController',
            'foreignCompany' => $foreignCompany,
            'form' => $form->createView()
        ));
    }



    /**
     * @Route("/report_purchases", name="report_purchases")
     */
    public function reportPurchases()
    {
        $purchase = $this->getDoctrine()->getRepository(Purchase::class)->findAll();

        $form = $this->createForm(ReportType::class);

        $form->offsetUnset('save');

        return $this->render('report/purchases.html.twig', [
            'controller_name' => 'ReportController',
            'purchase' => $purchase,
            'form' => $form->createView()
        ]);
    }


}
