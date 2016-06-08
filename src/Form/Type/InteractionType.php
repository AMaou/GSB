<?php

namespace GSB\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension;

class InteractionType extends AbstractType

{
	public $medicaments;
	
	public function __construct($medicaments)
	{
		$this->medicaments = $medicaments;
	}
		
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('med2','choice' ,array('choices' => array('label'=>'Médicaments','choices'=> $this->medicaments, 'expanded'=>false, 'multipe'=>false,)));
        
    }
    

    public function getName()
    {
        return 'interaction';
    }
    
    
}