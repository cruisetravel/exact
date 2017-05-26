<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ExactType.
 *
 * @author wicliff <wic@cruisetravel.nl>
 */
class ExactAnwbGolfType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'xmlanwbgolf',
            'Symfony\Component\Form\Extension\Core\Type\TextareaType',
            array(
                'label' => false,
            )
        )->add(
            'submit',
            'Symfony\Component\Form\Extension\Core\Type\SubmitType',
            array()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'exact';
    }
}
