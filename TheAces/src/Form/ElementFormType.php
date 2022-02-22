<?php

namespace App\Form;

use App\Entity\Element;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




class ElementFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type') //'type' => new sfValidatorString(array('min_length' => 4))
            ->add('ref') //
            ->add('nom')//'nom' => new sfValidatorString(array('required' => true))
            ->add('prix') //'prix' => new sfValidatorString(array('required' => true))
            ->add('description') //'description' => new sfValidatorString(array('required' => true))
            ->add('etat', ChoiceType::class, [
                'choices'  => [
                    ''=> false,
                    'Disponible' => true,
                    'Non Disponible' => true,
                ]])

            // 'etat => new sfValidatorChoice(array('choices' => array_keys(self::$subjects)))
            ->add('quantite')// 'quantite' => new sfValidatorString(array('required' => min_length' => 4)))
        ->add('image', FileType::class, [
        'mapped' => false
    ] )
            ->add('save' , SubmitType::class ,['label' => 'Confirmer']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Element::class,
        ]);
    }
}
