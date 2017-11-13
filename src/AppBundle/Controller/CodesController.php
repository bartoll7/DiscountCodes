<?php

namespace AppBundle\Controller;

use AppBundle\Form\CodeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    const FILE_NAME = 'codes.txt';

    /**
     * @Route("/codes", name="code")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(CodeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $quantity = $data['quantity'];
            $length = $data['length'];

            $codes = $this
                ->get('app.alphanumeric_code_generator')
                ->generateCodes($quantity, $length);

            $this->get('app.text_file_generator')
                ->generateFile($codes, self::FILE_NAME);

            return new Response(
                'File with codes was generated in your directory',
                Response::HTTP_CREATED
            );
        }

        return $this->render('base.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
