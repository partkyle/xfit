<?php

namespace xfit\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WorkoutType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('workout_date')
            ->add('ante')
            ->add('buy_in')
            ->add('cash_out')
        ;
    }

    public function getName()
    {
        return 'xfit_adminbundle_workouttype';
    }
}
