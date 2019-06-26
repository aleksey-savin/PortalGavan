<?php

namespace App\Form;

use App\Entity\AdditionalServices;
use App\Entity\ServicesSupplier;
use App\Entity\TouristGroup;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdditionalServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('touristGroup', EntityType::class, array(
                'label' => 'Туристическая Группа',
                'placeholder' => 'Выберите тур. группу',
                'class' => TouristGroup::class,
                'choice_label' => 'groupNumber',
                'attr' => array('class' => 'form-control')
            ))
            ->add('ServicesSupplier', EntityType::class, array(
                'label' => 'Вид услуги',
                'placeholder' => 'Выберите вид услуги',
                'class' => ServicesSupplier::class,
                'choice_label' => 'name',
                'attr' => array('class' => 'form-control'),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->where('t.isDeleted = :isDeleted')
                        ->setParameter(':isDeleted',false);
                }
            ))
            ->add('numberOfPersons', IntegerType::class, array(
                'label' => 'Количество человек',
                'attr' => array('class' => 'form-control')
            ))
            ->add('guideCommissionValue', NumberType::class, array(
                'label' => 'Комиссия гида, руб.',
                'attr' => array('class' => 'form-control')
            ))
            ->add('companyCommissionValue', NumberType::class, array(
                'label' => 'Комиссия компании, руб.',
                'attr' => array('class' => 'form-control')
            ))
            ->add('costPrice', NumberType::class, array(
                'label' => 'Себестоимость, руб.',
                'attr' => array('class' => 'form-control')
            ))
            ->add('incomeValue', NumberType::class, array(
                'label' => 'Приход, руб.',
                'attr' => array('class' => 'form-control')
            ))
            ->add('note', TextareaType::class, array(
                'label' => 'Примечание',
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Сохранить и закрыть',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->add('save_and_add', SubmitType::class, array(
                'label' => 'Сохранить и добавить ещё',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdditionalServices::class,
        ]);
    }
}
