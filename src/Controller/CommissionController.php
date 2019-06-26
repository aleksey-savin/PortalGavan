<?php

namespace App\Controller;

use App\Entity\Commission;
use App\Form\CommissionType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;




class CommissionController extends Controller
{
    /**
     * @Route("/commission", name="commission")
     * @Method({"GET"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $commission = $this->getDoctrine()->getRepository(commission::class)->findAll();

        return $this->render('commission/index.html.twig', array('commission' => $commission));
    }

    /**
     * @Route("/commission/new", name="new_commission")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function new(Request $request)
    {
        $tp = $request->query->get('trade_point');
        $repo = $this->getDoctrine()->getRepository('App:TradePoint');
        $found = $repo->find($tp);

        $new_commission = new commission();
        $commission = $this->createForm(commissionType::class, $new_commission);

        $commission->offsetUnset('tradePointId');

        $commission->handleRequest($request);

        $guideCommission = $commission->get('guideCommissionPct')->getData();
        $groupLeaderCommission = $commission->get('groupLeaderCommissionPct')->getData();
        $companyCommission = $commission->get('companyCommissionPct')->getData();
        $totalCommission = $commission->get('totalCommissionPct')->getData();
        $commissionsSum = $guideCommission + $groupLeaderCommission + $companyCommission;
        $epsilon = 0.00001;

        if ($commission->isSubmitted() and $commission->isValid() and abs($commissionsSum - $totalCommission) < $epsilon )
        {
            try{
                $new_commission->setTradePointId($found);
                $em = $this->getDoctrine()->getManager();
                $em->persist($new_commission);
                $em->flush();
                $this->addFlash('success', 'Отлично, новая коммиссия добавлена!');
                return $this->redirectToRoute('trade_point_show', array('id' => $tp));
            } catch(\Exception $e){
                $this->get('session')->getFlashBag()->add('error', 'Your custom message');

                $this->get('logger')->error($e->getMessage());

                return $this->redirect($request->headers->get('referer'));
            };


        }
        if ($commission->isSubmitted() and $commission->isValid() and $totalCommission !== $commissionsSum)
        {
            $this->addFlash('danger', 'Сумма коммиссий руководителя группы, гида и компании должна быть равна общей коммиссии');
        }

        return $this->render('commission/new.html.twig', array (
            'commission' => $commission->createView()
        ));
    }

    /**
     * @Route("/commission/edit/{id}", name="edit_commission")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function edit(Request $request, $id)
    {
        $tp = $request->query->get('trade_point');

        $edit_commission = $this->getDoctrine()->getRepository(commission::class)->find($id);

        $commission = $this->createForm(commissionType::class, $edit_commission);

        $commission->offsetUnset('tradePointId');

        $commission->handleRequest($request);

        if ($commission->isSubmitted() and $commission->isValid())
        {
            $guideCommission = $edit_commission->getGuideCommissionPct();
            $groupLeaderCommission = $edit_commission->getGroupLeaderCommissionPct();
            $companyCommission = $edit_commission->getCompanyCommissionPct();
            $totalCommission = $edit_commission->getTotalCommissionPct();
            $commissionsSum = ($guideCommission + $groupLeaderCommission + $companyCommission);
            $epsilon = 0.00001;

            if(abs($commissionsSum - $totalCommission) < $epsilon) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $this->addFlash('success', 'Отлично, изменения внесены успешно!');
                return $this->redirectToRoute('trade_point_show', array('id' => $tp));
            } else {
                $this->addFlash('danger', 'Сумма коммиссий руководителя группы, гида и компании должна быть равна общей коммиссии');
            }
        }
        return $this->render('commission/edit.html.twig', array (
            'commission' => $commission->createView()
        ));
    }

    /**
     * @Route("/commission/{id}", name="commission_show")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function show($id)
    {
        $commission = $this->getDoctrine()->getRepository(commission::class)->find($id);

        return $this->render('commission/show.html.twig', array ('commission'=>$commission));
    }

    /**
     * @Route("/commission/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $commission = $this->getDoctrine()->getRepository(commission::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($commission);
        $em->flush();

        $response = new Response();
        $response->send();
    }
}
