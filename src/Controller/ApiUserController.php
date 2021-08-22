<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\User;
use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class ApiUserController extends AbstractController
{
    /**
     * @Route("/api/customer/{id}/users", name="api_user_index", methods={"GET"})
     */
    public function showUsersIndex(Customer $customer, CustomerRepository $customerRepository): Response
    {
        return $this->json($customerRepository->find($customer), 200, [], ['groups' => 'show_customer_users_index']);
    }

    /**
     * @Route("/api/customer/{customerId}/user/{userId}", name="api_user_details", methods={"GET"})
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

    /**
     * @Route("/api/customer/{id}/user", name="api_user_create", methods={"POST"})
     */
    public function createUser(Request $request, Customer $customer, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $user = $serializer->deserialize($request->getContent(), User::class, 'json');
            $user->setCustomer($customer);
            $user->setCreatedAt(new \DateTime());

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($user, 201, [], ['groups' => 'create_user']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
