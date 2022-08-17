<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Customer;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'name'
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('quotes', CollectionType::class, [
                'label' => false,
                'entry_type' => QuoteType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('invoices', CollectionType::class, [
                'label' => false,
                'entry_type' => InvoiceType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
