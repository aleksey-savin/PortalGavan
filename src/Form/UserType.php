<?php

namespace App\Form;

use App\Entity\AppUsers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'E-mail',
                'attr' => array('class'=>'form-control')
            ))
            ->add('realName', TextType::class, array(
                'label' => 'Фамилия и Имя пользователя',
                'attr' => array('class'=>'form-control')
            ))
            ->add('role', ChoiceType::class, array(
              'label' => 'Роль пользователя',
              'placeholder' => 'Выберите роль',
              'choices' => array(
                  'Администратор' => 'ROLE_ADMIN',
                  'Гид' => 'ROLE_GUIDE'
              ),
              'attr' => array('class' => 'form-control')
            ))
            ->add('PLOTNumber', TextType::class, array(
                'label' => 'Номер ПЛОТ',
                'required' => false,
                'attr' => array('class'=>'form-control')
            ))
            ->add('isActive', CheckboxType::class, array(
                'label' => 'Пользователь активен',
                'attr' => array('class'=>'form-control'),
                'required' => false
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Пароль', 'attr' => array('class' => 'form-control')),
                'second_options' => array('label' => 'Подтверждение пароля', 'attr' => array('class' => 'form-control'))
            ))
            ->add('isDeleted', CheckboxType::class, array(
                'label' => 'Объект удалён',
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Сохранить',
                'attr' => array('class' => 'btn btn-success mt-3')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppUsers::class,
        ]);
    }
}
