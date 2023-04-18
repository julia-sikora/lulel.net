<?php

declare(strict_types=1);

namespace App\Model\Form;

class NavbarSearchModel
{
    private ?string $text;

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}