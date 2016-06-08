<?php

namespace GSB\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;

class InteractionType extends AbstractType
{
    public $medicaments;

    public function __construct($medicaments)
    {
        $this->medicaments = $medicaments;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('medicament2',  'choice',  array(
            'label' => 'Médicaments',
            'choices' =>  $this->medicaments,
            'expanded'=>false, 'multiple'=>false,
        ));
    }

    public function getName()
    {
        return 'interaction';
    }
}




























