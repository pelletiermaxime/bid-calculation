<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Vehicle;
use App\Enum\VehicleTypeEnum;
use Money\Money;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use InvalidArgumentException;
use ValueError;

class CarPriceController extends AbstractController
{
    public function __construct(private readonly Vehicle $vehicle) {}

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

        try {
            $typeEnum = VehicleTypeEnum::from($type);
        } catch (ValueError $e) {
            return $this->json(['error' => 'Invalid type'], 400, ['Access-Control-Allow-Origin' => '*']);
        }

        $this->vehicle->setBasePrice($basePrice);
        $this->vehicle->setType($typeEnum);
        $this->vehicle->calculatePrice();

        return $this->json(
            $this->vehicle->toJson(),
            200,
            ['Access-Control-Allow-Origin' => '*']
        );
    }
}
