<?php

namespace App\Form;

use App\Entity\ServicesSupplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicesSupplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Наименование',
                'attr' => array('class' => 'form-control')
            ))
            ->add('costPerPerson', NumberType::class, array(
                'label' => 'Себестоимость за человека, руб.',
                'attr' => array('class' => 'form-control')
            ))
            ->add('costForClient', NumberType::class, array(
                'label' => 'Стоимость для Клиента, руб.',
                'attr' => array('class' => 'form-control')
            ))
            ->add('guideCommissionPct', PercentType::class, array(
                'label' => 'Комиссия гида',
                'attr' => array('class' => 'form-control')
            ))
            ->add('contactName', TextType::class, array(
                'label' => 'Контактное лицо',
                'attr' => array('class' => 'form-control')
            ))
            ->add('contactNumber', TextType::class, array(
                'label' => 'Контактный номер',
                'attr' => array('class' => 'form-control')
            ))
            ->add('note', TextareaType::class, array(
                'label' => 'Примечание',
                'required' => false,
                'attr' => array('class' => 'form-control')
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
            'data_class' => ServicesSupplier::class,
        ]);
    }
}
