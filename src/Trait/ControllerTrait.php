<?php

declare(strict_types=1);

namespace App\Trait;

use App\Entity\User;

trait ControllerTrait
{
    protected function getUser(): ?User
    {
        return parent::getUser();
    }
}
