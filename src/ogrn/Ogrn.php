<?php

/**
 * Tiny PHP library for validating OGRN(ОГРН) and OGRNIP(ОГРНИП) business identifiers in Russia.
 *
 * It just verifies number length and last control digit, so if identifier passes validation it doesn't
 * mean that it exists in a real world. If you need to check that OGRN or OGRNIP exists visit
 * [http://egrul.nalog.ru](http://egrul.nalog.ru).
 *
 * PHP version ^ 5.3.3
 *
 * @category PHP
 * @package  Ybelenko\Ogrn
 * @author   Yuriy Belenko <yura-bely@mail.ru>
 * @license  MIT https://github.com/ybelenko/ogrn/blob/master/LICENSE
 * @version  GIT: <https://github.com/ybelenko/ogrn>
 * @link     https://github.com/ybelenko/ogrn
 */

namespace Ybelenko\Ogrn;

/**
 * Class without constructor.
 *
 * ОГРН (основной государственный регистрационный номер) — государственный регистрационный номер записи
 * о создании юридического лица либо записи о первом представлении в соответствии с Федеральным законом
 * Российской Федерации «О государственной регистрации юридических лиц» сведений о юридическом лице,
 * зарегистрированном до введения в действие указанного Закона (пункт 8 Правил ведения Единого
 * государственного реестра юридических лиц).
 *
 * Государственный регистрационный номер записи, вносимой в Единый государственный реестр юридических лиц,
 * состоит из 13 цифр, расположенных в следующей последовательности:
 * - С Г Г К К Н Н Х Х Х Х Х Ч
 * где:
 * - С (1-й знак) — признак отнесения государственного регистрационного номера записи:
 *   - к основному государственному регистрационному номеру (ОГРН)* — 1, 5 (присваивается юридическому лицу)
 *   - к иному государственному регистрационному номеру записи ЕГРЮЛ* (ГРН) — 2, 6, 7, 8, 9 (присваивается
 *     государственным учреждениям/образованиям)
 *   - к основному государственному регистрационному номеру индивидуального предпринимателя (ОГРНИП)* —
 *     3 (присваивается индивидуальному предпринимателю)
 *   - к иному государственному регистрационному номеру записи ЕГРИП * (ГРНИП) — 4
 *
 * В зависимости от принадлежности проставляется соответствующий номер. Юридическому лицу – цифра 1 (один),
 * индивидуальному предпринимателю – цифра 3 (три), государственным учреждениям – цифра 2 (два).
 *
 * - ГГ (со 2-го по 3-й знак) — две последние цифры года внесения записи в государственный реестр
 * - КК (4-й, 5-й знаки) — порядковый номер субъекта Российской Федерации по перечню субъектов Российской
 *   Федерации, установленному статьей 65 Конституции Российской Федерации
 * - НН (с 6-го по 7-й знак) — код налоговой инспекции
 * - ХХХХХ (с 8-го по 12-й знак) — номер записи, внесенной в государственный реестр в течение года
 * - Ч (13-й знак) — контрольное число: младший разряд остатка от деления предыдущего 12-значного числа
 *   на 11, если остаток от деления равен 10, то контрольное число равно 0 (нулю).
 *
 * @category PHP
 * @package  Ybelenko\Ogrn
 * @author   Yuriy Belenko <yura-bely@mail.ru>
 * @license  MIT https://github.com/ybelenko/ogrn/blob/master/LICENSE
 * @version  Release: @package_version@
 * @link     https://github.com/ybelenko/ogrn
 */

class Ogrn
{

    /**
     * Validates identifier length and last control digit.
     *
     * @param string $identifier identifier
     *
     * @return bool true if identifier is valid otherwise false
     */
    public static function validate($identifier)
    {
        $id = strval($identifier);
        if (preg_match('/^\d{13}$/', $id) !== 1 || intval($identifier) <= 0) {
            return false;
        }
        // remainder after division
        $rem = gmp_intval(
            gmp_mod(
                substr($id, 0, -1),
                11
            )
        );
        if (gmp_cmp($rem, 10) === 0) {
            $rem -= 10;
        }
        // control number
        $con = substr($id, -1);
        return (bool)(strval($rem) === $con);
    }
}
