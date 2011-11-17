<?php

namespace xfit\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EmailType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
        ;
    }

    public function getName()
    {
        return 'xfit_adminbundle_emailtype';
    }
}
