<?php
/**
 * Created by PhpStorm.
 * User: amadrocky
 * Date: 04/01/19
 * Time: 11:00
 */

namespace App\Service;

use App\Repository\CoffeeRepository;
use App\Repository\InfusionRepository;
use App\Repository\TeaRepository;

class MaxProductChecker
{
    private $coffeeRepository;
    private $teaRepository;
    private $infusionRepository;

    const MAX = 3;

    public function __construct(
        CoffeeRepository $coffeeRepository,
        TeaRepository $teaRepository,
        InfusionRepository $infusionRepository
    ) {
        $this->coffeeRepository = $coffeeRepository;
        $this->teaRepository = $teaRepository;
        $this->infusionRepository = $infusionRepository;
    }

    /**
     * @return bool
     */
    public function checkNoveltyNumber(): bool
    {
        return $this->countNumbers() < self::MAX;
    }

    /**
     * @return int
     */
    public function countNumbers(): int
    {
        $coffees = $this->coffeeRepository->findByNovelty(true);
        $teas = $this->teaRepository->findByNovelty(true);
        $infusions = $this->infusionRepository->findByNovelty(true);

        return count($coffees) + count($teas) + count($infusions) ?? 0;
    }

    /**
     * @return bool
     */
    public function checkHighlightedNumber(): bool
    {
        $coffees = $this->coffeeRepository->findByHighlighted(true);
        $teas = $this->teaRepository->findByHighlighted(true);
        $infusions = $this->infusionRepository->findByHighlighted(true);
        return count($coffees) + count($teas) + count($infusions) < self::MAX;
    }
}
