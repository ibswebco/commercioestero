<?php

namespace IBSWebCO\CommercioEstero\Traits;

use IBSWebCO\CommercioEstero\Attributes\EmptySerialize;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionProperty;
use RuntimeException;

trait Serializable
{
    protected function castOutputValue(mixed $value, int $depth = 3): mixed
    {
        if ($value instanceof \BackedEnum) {
            return $value->value;
        }

        if (is_null($value)) {
            return $this->readAttributes();
        }

        if ($value instanceof Collection || is_array($value)) {
            return collect($value)
                ->map(fn($v) => $this->castOutputValue($v, $depth))
                ->all();
        }

        return $value;
    }

    private function onlyPublicProperties(string $key, int $depth): mixed
    {
        $reflectionClass = new ReflectionClass($this);

        $property = $reflectionClass->getProperty($key);

        if ($property && $property->isPublic()) {
            return $this->castOutputValue($property->getValue(), $depth - 1);
        }

        /*foreach (
            $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC)
            as $property
        ) {
            return $this->castOutputValue($property->getValue(), $depth - 1);
            }*/

        return "";
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

        return [];
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
