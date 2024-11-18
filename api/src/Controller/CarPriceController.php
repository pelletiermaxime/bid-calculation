<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Vehicle;
use InvalidArgumentException;
use Money\Money;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CarPriceController extends AbstractController
{
    /**
     * Calculate the total car price of a vehicle.
     *
     * Add fees to the base car price depending on its type.
     */
    #[Route('/api/calculate-car-price/{price}/{type}', name: 'calculate_car_price', methods: ['GET'])]
    public function calculateCarPrice(string $price, string $type): JsonResponse
    {
        try {
            $basePrice = Money::CAD($price);
        } catch (InvalidArgumentException $e) {
            return $this->json(['error' => 'Invalid price'], 400, ['Access-Control-Allow-Origin' => '*']);
        }

        $vehicle = new Vehicle($basePrice, $type);
        $vehicle->calculatePrice();

        $basicFee = Money::CAD(3980);
        $specialFee = Money::CAD(796);
        $associationFee = Money::CAD(500);
        $storageFee = Money::CAD(10000);
        $totalPrice = $basePrice->add($basicFee)->add($specialFee)->add($associationFee)->add($storageFee);

        return $this->json([
            $vehicle->toJson(),
        ], 200, ['Access-Control-Allow-Origin' => '*']);
    }
}
