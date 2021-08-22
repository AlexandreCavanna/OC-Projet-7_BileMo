<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\User;
use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

    /**
     * @Route("/api/customer/{customerId}/user/{userId}", name="api_user_details")
     * @ParamConverter("customer", options={"mapping": {"customerId": "id"}})
     * @ParamConverter("user", options={"mapping": {"userId": "id"}})
     */
    public function showUserDetails(Customer $customer, User $user, UserRepository $userRepository): Response
    {
        return $this->json(
            $userRepository->findOneBy(['customer' => $customer, 'id' => $user]),
            200,
            [],
            ['groups' => 'show_customer_user_details']
        );
    }
}
