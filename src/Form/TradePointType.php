<?php

namespace App\Form;

use App\Entity\TradePoint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TradePointType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Наименование',
                'attr' => array('class'=>'form-control')
            ))
            ->add('address', TextType::class, array(
                'label' => 'Адрес',
                'attr' => array('class'=>'form-control'),
                'required' => false
            ))
            ->add('contactPerson', TextType::class, array(
                'label' => 'Контактное лицо',
                'attr' => array('class'=>'form-control'),
                'required' => false
            ))
            ->add('contactNumber', TextType::class, array(
                'label' => 'Контактный номер',
                'attr' => array('class'=>'form-control'),
                'required' => false
            ))
            ->add('reportsFormat', TextType::class, array(
                'label' => 'Формат отчётов',
                'attr' => array('class'=>'form-control'),
                'required' => false
            ))
            ->add('note', TextAreaType::class, array(
                'label' => 'Примечание',
                'required' => false,
                'attr' => array('class'=>'form-control')
            ))
            ->add('isDeleted', CheckboxType::class, array(
                'label' => 'Объект удалён',
                'required' => false,
                'attr' => array('class' => 'form-control')
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
            'data_class' => TradePoint::class,
        ]);
    }
}


