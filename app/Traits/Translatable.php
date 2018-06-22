<?php

namespace App\Traits;

use App;

/**
 * Trait Translatable
 *
 * @property array $translatable
 *
 * @package App\Traits
 */
trait Translatable
{
    /**
     * Аксессор атрибутов
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (!$this->isTranslatableAttribute($key)) {
            return parent::getAttribute($key);
        }

        return $this->getTranslation($key, App::getLocale());
    }

    /**
     * Перевод
     *
     * @param string $key
     * @param string $locale
     *
     * @return mixed
     */
    public function getTranslation(string $key, string $locale)
    {
        $translation = $key !== null ? $this->getAttributes()["{$key}_{$locale}"] : null;

        if ($this->hasGetMutator($key))
            return $this->mutateAttribute($key, $translation);

        return $translation;
    }

    /**
     * Атрибут переводим?
     *
     * @param string $key
     *
     * @return bool
     */
    public function isTranslatableAttribute(string $key) : bool
    {
        return in_array($key, $this->getTranslatableAttributes());
    }

    /**
     * Переводимые атрибуты
     *
     * @return array
     */
    public function getTranslatableAttributes() : array
    {
        return is_array($this->translatable) ? $this->translatable : [];
    }
}