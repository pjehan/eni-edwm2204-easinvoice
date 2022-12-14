<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CustomerType;

/**
 * @Route("/customers")
 * @IsGranted("ROLE_USER")
 */
class CustomerController extends AbstractController
{
    /**
     * @Route("/", name="customer_index")
     */
    public function index(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findBy(['user' => $this->getUser()], ['name' => 'ASC']);

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

    /**
     * @Route("/create", name="customer_create")
     */
    public function create(Request $request, CustomerRepository $customerRepository, FileUploader $fileUploader): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $logoFile */
            $logoFile = $form->get('logo')->getData();

            if ($logoFile) {
                $logoFileName = $fileUploader->upload($logoFile);
                $customer->setLogo($logoFileName);
            }

            $customer->setUser($this->getUser());
            $customerRepository->add($customer, true);

            return $this->redirectToRoute('customer_index');
        }

        return $this->render('customer/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function dropdown(CustomerRepository $customerRepository): Response
    {
        return $this->render('customer/_customer_dropdown.html.twig', [
            'customers' => $customerRepository->findAll()
        ]);
    }
}
