<?php

namespace App\Traits;

trait Naming
{
    protected string $entity;

    public function __construct()
    {
        $this->entity = lcfirst(class_basename(self::$model));
    }

    public static function getFieldName(string $field): string
    {
        return __('mp_logistic.' . self::getEntityName() . ('_fields.' . $field));
    }

    public static function getActionName(string $field): string
    {
        return __('mp_logistic.' . self::getEntityName() . ('_actions.' . $field));
    }

    public static function getModelLabel(): string
    {
        return __('mp_logistic.' . self::getEntityName());
    }

    public static function getPluralModelLabel(): string
    {
        return __('mp_logistic.' . self::getEntityName() . 's');
    }

    protected static function getEntityName(): string
    {
        return lcfirst(class_basename(self::$name));
    }
}
