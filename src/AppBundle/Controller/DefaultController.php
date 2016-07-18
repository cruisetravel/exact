<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\DataTransformer\ExactTransformer;
use AppBundle\Form\Type\ExactType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\Type\ExactType');
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $transformer = new ExactTransformer();

            return new Response(
                $transformer->transform($form->getData()['xml']),
                Response::HTTP_OK,
                array(
                    'Content-type' => 'text/csv',
                    'Content-disposition' => 'attachment;filename=ExactPostingSteps.csv',
                )
            );
        }
        
        return $this->render('default/exact.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'form' => $form->createView(),
        ));
    }
}
