<?php

namespace IBSWebCO\CommercioEstero\Traits;

use Illuminate\Support\Collection;
use ReflectionClass;
use RuntimeException;

trait Serializable
{
    protected function castOutputValue(mixed $value, int $depth = 3): mixed
    {
        if ($value instanceof \BackedEnum) {
            return $value->value;
        }

        if ($value instanceof Collection || is_array($value)) {
            return collect($value)
                ->map(fn($v) => $this->castOutputValue($v, $depth))
                ->all();
        }

        return $value;
    }

    public function toArray(int $depth = 3): array
    {
        if ($depth < 0) {
            return [];
        }

        return collect(get_object_vars($this))
            ->filter(function ($value, $key) {
                $reflectionClass = new ReflectionClass($this);

                $property = $reflectionClass->getProperty($key);

                return $property && $property->isPublic();
            })
            ->mapWithKeys(
                fn($value, $key) => [
                    $key => $this->castOutputValue(
                        value: $value,
                        depth: $depth - 1,
                    ),
                ],
            )
            ->all();
    }

    public function toJson(): string
    {
        $json = json_encode(value: $this->toArray(), flags: JSON_PRETTY_PRINT);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $json;
        }

        throw new RuntimeException("JSON error: " . json_last_error_msg());
    }
}
