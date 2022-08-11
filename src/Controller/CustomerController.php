<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
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
    public function index(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findBy([], ['name' => 'ASC']);

        return $this->render('customer/index.html.twig', [
            'customers' => $customers,
        ]);
    }

    /**
     * @Route("/{id}", name="customer_show", requirements={"id"="\d+"})
     */
    public function show(Customer $customer): Response
    {
        return $this->render('customer/show.html.twig', ['customer' => $customer]);
    }
}
