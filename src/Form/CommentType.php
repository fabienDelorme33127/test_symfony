<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CommentType extends AbstractType
{

    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu', null, [
                'label' => 'Votre commentaire',
                'attr' => [
                    'placeholder' => "Votre commentaire"
                ]
            ])
            ->add('author', null, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => "Votre nom"
                ]
            ])
            ->add('condition', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Accepter les conditions'
            ])
            ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
                $form = $event->getForm();
                if($this->user !== null){
                    $form->get('author')->setData($this->user->getUserIdentifier());
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
