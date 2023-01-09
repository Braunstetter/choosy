<?php

namespace App\Controller;

use Braunstetter\Choosy\Form\ChoosyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TestController extends AbstractController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function test(Environment $environment, FormFactoryInterface $formFactory, Request $request): Response
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
}