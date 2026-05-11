<?php

namespace SheavesCapital\TwilioVerify\DTO;

use Illuminate\Support\Arr;

final class Lookup
{
    public static function fromJson(array $lookup): ?self
    {
        if (Arr::get($lookup, 'carrier') === null) {
            return null;
        }

        return new self(
            carrier: Carrier::fromJson(Arr::get($lookup, 'carrier')),
        );
    }

    public function __construct(public Carrier $carrier) {}

    public static function fake(?Carrier $carrier = null): self
    {
        return new self(
            carrier: $carrier ?? Carrier::fake(),
        );
    }
}
