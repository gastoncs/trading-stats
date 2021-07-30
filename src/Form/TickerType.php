<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/26/21
 * Time: 5:58 PM
 */

namespace App\Form;

use App\Entity\Ticker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TickerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', null, [
                'attr' => ['autofocus' => true],
                'label' => 'Ticker',
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Notas',
            ]);

        $builder->get('code')->addModelTransformer(new CallbackTransformer(
            function ($tagsAsArray) {
                return strtoupper($tagsAsArray);
            },
            function ($tagsAsString) {
                return strtoupper($tagsAsString);
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticker::class
        ]);
    }
}