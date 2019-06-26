<?php

namespace App\Form;

use App\Entity\Commission;
use App\Entity\TradePoint;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CommissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tradePointId', EntityType::class, array(
                'label' => 'Магазин',
                'class' => TradePoint::class,
                'choice_label' => 'name',
                'placeholder' => 'Выберите магазин',
                'attr' => array('class' => 'form-control')
            ))
            ->add('name', TextType::class, array(
                'label' => 'Наименование',
                'attr' => array('class'=>'form-control')
            ))
            ->add('type', ChoiceType::class, array(
                'label' => 'Тип комиссии',
                'attr' => array('class'=> 'form-control'),
                'choices' => array(
                    'Процент' => 'percent'
                )
            ))
            ->add('totalCommissionPct', PercentType::class, array(
                'label' => 'Общая комиссия',
                'scale' => 2,
                'attr' => array('class'=>'form-control')                
            ))
            ->add('ftotalCommissionPct', PercentType::class, array(
                'label' => 'Общая комиссия (информация для гида)',
                'scale' => 2,
                'attr' => array('class'=>'form-control')
            ))
            ->add('groupLeaderCommissionPct', PercentType::class, array(
                'label' => 'Комиссия руководителя группы',
                'scale' => 2,
                'attr' => array('class'=>'form-control')
            ))
            ->add('guideCommissionPct', PercentType::class, array(
                'label' => 'Комиссия гида',
                'scale' => 2,
                'attr' => array('class'=>'form-control')
            ))
            ->add('companyCommissionPct', PercentType::class, array(
                'label' => 'Комиссия компании',
                'scale' => 2,
                'attr' => array('class'=>'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Сохранить',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commission::class,
        ]);
    }
}


