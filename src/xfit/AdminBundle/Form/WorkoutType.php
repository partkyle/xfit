<?php

namespace xfit\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WorkoutType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('required'=>true))
            ->add('workout_date', 'date', array('required'=>true))
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
