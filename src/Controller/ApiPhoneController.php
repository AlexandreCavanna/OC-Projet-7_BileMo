<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiPhoneController extends AbstractController
{
    /**
     * @Route("/api/phone/{id}", name="api_phone_details", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function showPhoneDetails(Phone $phone, PhoneRepository $phoneRepository): Response
    {
        return $this->json(
            $phoneRepository->find($phone)
        );
    }
}
