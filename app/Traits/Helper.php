<?php

namespace App\Traits;

use App;

/**
 * Trait Helper
 *
 * @package App\Traits
 */
trait Helper
{
    /**
     * Обрезает строку до определённого количества символов не разбивая слова.
     * Поддерживает многобайтовые кодировки.
     *
     * @param string $str строка
     * @param int $length длина, до скольки символов обрезать
     * @param string $postfix постфикс, который добавляется к строке
     * @param string $encoding кодировка, по-умолчанию 'UTF-8'
     *
     * @return string обрезанная строка
     */
    protected function mbCutString($str, $length, $postfix='...', $encoding='UTF-8')
    {
        if (mb_strlen($str, $encoding) <= $length)
            return $str;

        $tmp = mb_substr($str, 0, $length, $encoding);
        return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
    }
}