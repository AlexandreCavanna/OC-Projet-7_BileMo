<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiPhoneController extends AbstractController
{
    /**
     * @Route("/api/phones", name="api_phone_index", methods={"GET"})
     * @OA\Response(
     *     response="200",
     *     description="Return all phones of BileMo.",
     *     @Model(type=Phone::class)
     * )
     * @OA\Response(
     *     response="404",
     *     description="Return a 404 not found if the page parameter don't exist.",
     * )
     * @OA\Parameter(
     *     name="page",
     *     in="path",
     *     description="Page of the list.",
     *     required=false
     * )
     * @OA\Tag(name="Phone")
     * @Security(name="Bearer")
     */
    public function showPhonesIndex(PhoneRepository $phoneRepository): Response
    {
        return $this->json($phoneRepository->findAll());
    }

    /**
     * @Route("/api/phone/{id}", name="api_phone_details", requirements={"id"="\d+"}, methods={"GET"})
     * @OA\Response(
     *     response="200",
     *     description="Return product details.",
     *     @Model(type=Phone::class)
     * )
     * @OA\Response(
     *     response="404",
     *     description="Return a 404 not found if the product don't exist",
     * )
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the phone.",
     *     required=true
     * )
     * @OA\Tag(name="Phone")
     * @Security(name="Bearer")
     */
    public function showPhoneDetails(Phone $phone, PhoneRepository $phoneRepository): Response
    {
        return $this->json($phoneRepository->find($phone));
    }
}
