<?php
// src/EvryThing/BlogBundle/Form/CommentaireType.php

namespace EvryThing\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentaireType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('contenu', 'textarea');		
		$builder->add('submit', 'submit');
	}

    public function getName()
    {
        return 'commentaire';
    }
}