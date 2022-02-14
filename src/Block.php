<?php

namespace Carrd\PhpBlockchain;

use DateTimeImmutable;

class Block
{
    private int $number;
    private int $nonce;
    private string $data;
    private string $timestamp;
    private string $hash;
    private ?string $previousHash = null;

    public function __construct(int $nonce, string $data)
    {
        $this->nonce = $nonce;
        $this->data = $data;
        $this->timestamp = (new DateTimeImmutable())->format('Y/m/d H:i:s');
        $this->hash = hash('SHA256', $data . $nonce);
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setPreviousHash(string $hash): void
    {
        $this->previousHash = $hash;
    }

    public function getPreviousHash(): ?string
    {
        return $this->previousHash;
    }

    public function isValid(): bool
    {
        return $this->hash === hash('SHA256', $this->data . $this->nonce);
    }
}
