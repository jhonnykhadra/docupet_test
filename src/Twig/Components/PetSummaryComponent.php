<?php

namespace App\Twig\Components;

use App\Entity\Pet;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class PetSummaryComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public ?Pet $pet = null;
}