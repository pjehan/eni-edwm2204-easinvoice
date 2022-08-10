<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/customers")
 */
class CustomerController extends AbstractController
{
    /**
     * @Route("/", name="customer_index")
     */
    public function index(): Response
    {
        $customers = [
            [
                'id' => 1,
                'name' => 'Client 1'
            ],
            [
                'id' => 2,
                'name' => 'Client 2'
            ],
            [
                'id' => 3,
                'name' => 'Client 3'
            ]
        ];

        return $this->render('customer/index.html.twig', [
            'customers' => $customers,
        ]);
    }

    /**
     * @Route("/{id}", name="customer_show", requirements={"id"="\d+"})
     */
    public function show(int $id): Response
    {
        return $this->render('customer/show.html.twig', ['id' => $id]);
    }
}
