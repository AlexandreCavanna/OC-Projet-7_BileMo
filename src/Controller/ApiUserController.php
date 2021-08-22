<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController
{
    /**
     * @Route("/api/users", name="api_user_index")
     */
    public function showUsersIndex(CustomerRepository $customerRepository): Response
    {
        return $this->json($customerRepository->findAll(), 200, [], ['groups' => 'show_users_index']);
    }
}
