<?php

namespace App\Form;

use App\Entity\Commission;
use App\Entity\Purchase;
use App\Entity\TouristGroup;
use App\Entity\TradePoint;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityManagerInterface;

class PurchaseType extends AbstractType
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

    public function addElements(FormInterface $form, TradePoint $tradePoint = null) {
        $form ->add('touristGroup', EntityType::class, array(
            'label' => 'Туристическая Группа',
            'class' => TouristGroup::class,
            'choice_label' => 'id',
            'attr' => array('class' => 'form-control')
        ))

         ->add('tradePoint', EntityType::class, array(
            'label' => 'Магазин',
            'class' => TradePoint::class,
            'placeholder' => 'Выберите магазин',
            'choice_label' => 'name',
            'attr' => array ('class' => 'form-control'),
            'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('t')
                ->where('t.isDeleted = :isDeleted')
                ->setParameter(':isDeleted',false);
            }
        ));

        $commissions = array();

        if ($tradePoint) {
            $repoCommission = $this->em->getRepository('App:Commission');

            $commissions = $repoCommission->createQueryBuilder("q")
                ->where("q.tradePointId = :tradePointId")
                ->setParameter('tradePointId', $tradePoint->getId())
                ->getQuery()
                ->getResult();
        }

        $form->add('commission', EntityType::class, array(
            'label' => 'Комиссия',
            'placeholder' => 'Выберите коммиссию',
            'class' => Commission::class,
            'choice_label' => 'name',
            'choices' => $commissions,
            'attr' => array ('class' => 'form-control')
            ))
            ->add('salesReceipt', NumberType::class, array(
                'label' => 'Сумма Покупки',
                'attr' => array('class' => 'form-control')
            ))
            ->add('date', DateType::class, array(
                'label' => 'Дата Покупки',
                'attr' => array('class' => 'form-control'),
                'widget' => 'single_text'
            ))
            ->add('groupLeaderCommissionValue', NumberType::class, array(
                'scale' => 0,
                'rounding_mode' => NumberToLocalizedStringTransformer::ROUND_DOWN,
                'label' => 'Комиссия Руководителя Группы',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('guideCommissionValue', NumberType::class, array(
                'label' => 'Комиссия Гида',
                'scale' => 0,
                'rounding_mode' => NumberToLocalizedStringTransformer::ROUND_DOWN,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('companyCommissionValue', NumberType::class, array(
                'label' => 'Комиссия Компании',
                'scale' => 0,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Сохранить и закрыть',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->add('save_and_add', SubmitType::class, array(
                'label' => 'Сохранить и добавить ещё',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));;
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Search for selected City and convert it into an Entity
        $tradePoint = $this->em->getRepository('App:TradePoint')->find($data['tradePoint']);

        $this->addElements($form, $tradePoint);
    }

    function onPreSetData(FormEvent $event) {
        $purchase = $event->getData();
        $form = $event->getForm();

        // When you create a new person, the City is always empty
        $tradePoint = $purchase->getTradePoint() ? $purchase->getTradePoint() : null;

        $this->addElements($form, $tradePoint);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Purchase::class,
        ]);
    }
}
