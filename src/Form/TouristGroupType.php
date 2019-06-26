<?php

namespace App\Form;

use App\Entity\AppUsers;
use App\Entity\ForeignCompany;
use App\Entity\TouristGroup;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TouristGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /* ->add('groupNumber', TextType::class, array(
                'label' => 'Номер группы',
                'attr' => array('class'=>'form-control')
            )) */
            ->add('appUser', EntityType::class, array(
                'label' => 'Гид',
                'placeholder' => 'Выберите пользователя',
                'class' => AppUsers::class,
                'choice_label' => 'realName',
                'attr' => array('class' => 'form-control'),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.role = :Role')
                        ->setParameter(':Role', 'ROLE_GUIDE');
                }
            ))
            ->add('foreignCompany', EntityType::class, array(
                'label' => 'Иностранная компания',
                'placeholder' => 'Выберите компанию',
                'class' => ForeignCompany::class,
                'choice_label' => 'name',
                'required' => false,
                'attr' => array('class' => 'form-control'),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->where('f.isDeleted = :isDeleted')
                        ->setParameter(':isDeleted',false);
                }
            ))
            ->add('numberOfPersons', IntegerType::class, array(
                'label' => 'Общее количество человек',
                'attr' => array('class'=>'form-control')
            ))
            ->add('numberOfChildPersons', IntegerType::class, array(
                'label' => 'Количество детей',
                'required' => false,
                'attr' => array('class'=>'form-control')
            ))
            ->add('dateOfArrival', DateType::class, array(
                'label' => 'Дата заезда',
                'attr' => array('class'=>'form-control'),
                'widget'=>'single_text'
            ))
            ->add('dateOfDeparture', DateType::class, array(
                'label' => 'Дата выезда',
                'attr' => array('class'=>'form-control', 'type'=>'date'),
                'widget'=>'single_text'
            ))
            ->add('note', TextAreaType::class, array(
                'label' => 'Примечание',
                'required' => false,
                'attr' => array('class'=>'form-control')
            ))
            ->add('notifyGuide', CheckboxType::class, array(
                'label' => 'Уведомить гида',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('status', ChoiceType::class, array(
                'label' => 'Статус группы',
                'choices' => array(
                    'Новая группа' => 'newGroup',
                    'Запрос на утверждение' => 'approveRequest',
                    'Отчёт утверждён' => 'reportApproved',
                    'В архиве' => 'archived'
                ),
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Сохранить',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))

            ->add('expenseMeeting', NumberType::class, array(
                'label' => 'Встреча',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseTransport', NumberType::class, array(
                'label' => 'Транспорт по городу',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseSeeingOff', NumberType::class, array(
                'label' => 'Проводы',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseTicketsPerPerson', NumberType::class, array(
                'label' => 'Билеты',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseEcoDuesPerPerson', NumberType::class, array(
                'label' => 'Экосбор',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseBoatPerAdultPerson', NumberType::class, array(
                'label' => 'Лодка',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseBread', NumberType::class, array(
                'label' => 'Хлеб',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('incomeServicesPaymentPerPerson', NumberType::class, array(
                'label' => 'Плата за услуги',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseTicketsNumberOfPersons', NumberType::class, array(
                'label' => 'Расходы на билеты, количество человек',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseEcoDuesNumberOfPersons', NumberType::class, array(
                'label' => 'Расходы на экосбор, количество человек',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseBoatNumberOfPersons', NumberType::class, array(
                'label' => 'Расходы на лодку, количество человек',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('incomeServicesPaymentNumberOfPersons', NumberType::class, array(
                'label' => 'Плата за услуги, количество человек',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))

            ->add('expenseTicketsTotal', NumberType::class, array(
                'label' => 'Билеты, стоимость за группу',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseEcoDuesTotal', NumberType::class, array(
                'label' => 'Экосбор, стоимость за группу',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseBoatTotal', NumberType::class, array(
                'label' => 'Лодка, стоимость за группу',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('incomeServicesPaymentTotal', NumberType::class, array(
                'label' => 'Плата за услуги, стоимость за группу',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseArMuseumPerPerson', NumberType::class, array(
                'label' => 'Музей Арсеньева',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseArMuseumNumberOfPersons', NumberType::class, array(
                'label' => 'Расходы на музей, количество человек',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseArMuseumTotal', NumberType::class, array(
                'label' => 'Музей Арсеньева, стоимость за группу',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseTuriyRogPerPerson', NumberType::class, array(
                'label' => 'Турий Рог',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseTuriyRogNumberOfPersons', NumberType::class, array(
                'label' => 'Расходы на Турий Рог, количество человек',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('expenseTuriyRogTotal', NumberType::class, array(
                'label' => 'Турий рог, стоимость за группу',
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TouristGroup::class,
        ]);
    }
}


