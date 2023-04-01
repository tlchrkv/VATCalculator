<?php

declare(strict_types=1);

namespace App\Entity\Shared;

use App\Exceptions\InvalidCountryCode;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ISO 3166-1
 */
final class CountryCode
{
    #[Assert\NotBlank]
    private readonly string $value;

    public function __construct(string $value)
    {
        if (strlen($value) !== 2) {
            throw new InvalidCountryCode();
        }

        $this->value = strtoupper($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
