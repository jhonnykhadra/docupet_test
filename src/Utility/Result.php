<?php

namespace App\Utility;

class Result
{
    private bool $success;
    private mixed $data;
    private ?string $error;

    private function __construct(bool $success, mixed $data = null, ?string $error = null)
    {
        $this->success = $success;
        $this->data = $data;
        $this->error = $error;
    }

    public static function success(mixed $data): self
    {
        return new self(true, $data);
    }

    public static function failure(string $error): self
    {
        return new self(false, null, $error);
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getError(): ?string
    {
        return $this->error;
    }
}
