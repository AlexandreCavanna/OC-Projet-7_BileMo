<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\User;
use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class ApiUserController extends AbstractController
{
    /**
     * @Route("/api/customer/{id}/users", name="api_user_index", methods={"GET"})
     * @IsGranted("USER_INDEX", subject="customer")
     * @OA\Response(
     *     response=200,
     *     description="Return all users of a customer.",
     *     @Model(type=User::class, groups={"show_customer_users_index"})
     * )
     *
     * @OA\Response(
     *     response="404",
     *     description="Return a 404 not found if the page parameter don't exist.",
     * )
     *
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Unique identifier of the customer.",
     *     required=true
     * )
     *
     * * @OA\Parameter(
     *     name="offset",
     *     in="query",
     *     description="The number of items to skip before starting to collect the result set.",
     *     required=false,
     * )

     * @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="The number of items to return.",
     *     required=false,
     * )
     *
     * @OA\Tag(name="User")
     * @Security(name="Bearer")
     */
    public function showUsersIndex(Request $request, Customer $customer, UserRepository $userRepository): Response
    {

        return $this->json(
            $userRepository->getPaginatedUsers($request),
            200,
            [],
            ['groups' => 'show_customer_users_index']
        );
    }

    /**
     * @Route("/api/customer/{customerId}/user/{userId}", name="api_user_details", methods={"GET"})
     * @ParamConverter("customer", options={"mapping": {"customerId": "id"}})
     * @ParamConverter("user", options={"mapping": {"userId": "id"}})
     * @IsGranted("USER_VIEW", subject="user")
     * @OA\Response(
     *     response=200,
     *     description="Return user of a customer.",
     * )
     * @OA\Response(
     *     response="404",
     *     description="Return a 404 not found if the page parameter don't exist.",
     * )
     * @OA\Tag(name="User")
     */
    public function showUserDetails(User $user): Response
    {
        return $this->json(
            $user,
            200,
            [],
            ['groups' => 'show_customer_user_details']
        );
    }

    /**
     * @Route("/api/customer/{id}/user", name="api_user_create", methods={"POST"})
     * @IsGranted("USER_CREATE", subject="customer")
     * @OA\Response(
     *     response="201",
     *     description="Create a new user for a customer."
     * )
     * @OA\Response(
     *     response="400",
     *     description="Show errors validation."
     * )
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Unique identifier of the customer",
     *     required=true
     * )
     * @OA\Tag(name="User")
     * @Security(name="Bearer")
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

    /**
     * @Route("/api/customer/{customerId}/user/{userId}", name="api_user_delete", methods={"DELETE"})
     * @ParamConverter("customer", options={"mapping": {"customerId": "id"}})
     * @ParamConverter("user", options={"mapping": {"userId": "id"}})
     * @IsGranted("USER_DELETE", subject="user")
     * @OA\Response(
     *     response="204",
     *     description="Delete user of a customer."
     * )
     * @OA\Tag(name="User")
     * @Security(name="Bearer")
     */
    public function deleteUser(User $user, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->json(['status' => 204, 'message' => 'This User has been deleted.'], 204);
    }
}
