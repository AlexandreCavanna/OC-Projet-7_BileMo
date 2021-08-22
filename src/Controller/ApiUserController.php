<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController
{
    /**
     * @Route("/api/customer/{id}/users", name="api_user_index")
     */
    public function showUsersIndex(Customer $customer, CustomerRepository $customerRepository): Response
    {
        return $this->json($customerRepository->find($customer), 200, [], ['groups' => 'show_customer_users_index']);
    }
}
