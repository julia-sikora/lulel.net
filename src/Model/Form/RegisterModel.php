<?php

declare(strict_types=1);

namespace App\Model\Form;

class RegisterModel
{
    private ?string $email;
    private ?string $nickname;
    private ?string $password;
    private ?string $appPassword;

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $name): void
    {
        $this->nickname = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getAppPassword(): ?string
    {
        return $this->appPassword;
    }

    public function setAppPassword(?string $appPassword): void
    {
        $this->appPassword = $appPassword;
    }
}