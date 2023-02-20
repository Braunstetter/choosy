<?php

namespace App\Controller;

use Braunstetter\Choosy\Form\ChoosyEntityType;
use Braunstetter\Choosy\Form\ChoosyType;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{

    public function test(Environment $environment, FormFactoryInterface $formFactory): Response
    {
        $form = $formFactory->createBuilder();

        $form->add('choices', ChoosyType::class, [
            'choices'  => [
                'Maybe' => null,
                'Yes' => true,
                'No' => false,
            ],
        ]);

        return new Response(
            $environment->render('index.html.twig', [
                'form' => $form->getForm()->createView()
            ])
        );
    }

    public function testEntityForm(Environment $environment, FormFactoryInterface $formFactory): Response
    {
        $form = $formFactory->createBuilder();

        $form->add('choices', ChoosyEntityType::class, [
            'choices'  => [
                new StdClass(),
                new StdClass(),
            ],
        ]);

        return new Response(
            $environment->render('index.html.twig', [
                'form' => $form->getForm()->createView()
            ])
        );
    }
}