<?php

namespace App\Form;

use App\Entity\AppUsers;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', DateType::class, array(
                'label' => 'C',
                'attr' => array('class'=>'form-control'),
                'widget'=>'single_text',
                'required' => true
            ))
            ->add('till', DateType::class, array(
                'label' => 'по',
                'attr' => array('class'=>'form-control'),
                'widget'=>'single_text',
                'required' => true
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Получить отчёт',
                'attr' => array('class' => 'btn btn-success mt-3')
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
