<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Fees\Association\Association;
use App\Entity\Fees\Basic\Basic;
use App\Entity\Fees\FeeInterface;
use App\Entity\Fees\Special\Special;
use App\Entity\Fees\Storage\Storage;

class FeesFactory
{
    /**
     * @return array<FeeInterface>
     */
    public static function create(): array
    {
        return [
            new Basic(),
            new Special(),
            new Association(),
            new Storage(),
        ];
    }
}
