<?php

namespace App\DTO;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use ReflectionClass;
use ReflectionException;

abstract class AbstractDTO implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): self
    {
        return self::fromJson($value);
    }

    public function set($model, $key, $value, $attributes): string
    {
        return $value->toJson();
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @param string $json
     * @return static
     */
    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        if (empty($data)) {
            return new static();
        }
        $instance = new static();
        $instance->__construct($data);
        return $instance;
    }

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $propertyType = $this->getPropertyType($key);
                if (is_subclass_of($propertyType, AbstractDTO::class)) {
                    $this->{$key} = new $propertyType($value);
                } else {
                    $this->{$key} = $value;
                }
            }
        }
    }


    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new static($data);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $result = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($value instanceof AbstractDTO) {
                // Если свойство является DTO, преобразуем его в массив
                $result[$key] = $value->toArray();
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * @param array $items
     * @return static[]
     */
    public static function fromCollection(array $items): array
    {
        return array_map(function ($item) {
            return self::fromArray($item);
        }, $items);
    }

    /**
     * @param array $collection
     * @return array
     */
    public static function toCollection(array $collection): array
    {
        return array_map(function (self $dto) {
            return $dto->toArray();
        }, $collection);
    }

    /**
     * @param string $property
     * @return string|null
     */
    private function getPropertyType(string $property): ?string
    {
        /** @var AbstractDTO|ReflectionClass $reflection */
        $reflection = new ReflectionClass($this);
        try {
            $property = $reflection->getProperty($property);
        } catch (ReflectionException $e) {
            return null;
        }

        $type = $property->getType();
        return $type ? $type->getName() : null;
    }
}
