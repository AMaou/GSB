<?php

namespace GSB\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class InteractionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'text')
            ->add('Id', 'textarea');
        
            ->add('medId', 'text')
            ->add('medId', 'textarea');
    }

    public function getId()
    {
        return 'interaction';
    }
    
      public function getMedId()
    {
        return 'interaction';
    }
}