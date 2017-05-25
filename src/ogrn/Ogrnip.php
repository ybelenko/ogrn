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
 * ОГРНИП — основной государственный регистрационный номер индивидуального предпринимателя.
 * Номер присваивается в налоговой инспекции при государственной регистрации физического лица
 * в качестве индивидуального предпринимателя (ИП) и внесении в Единый государственный реестр
 * индивидуальных предпринимателей записи об индивидуальном предпринимателе.
 *
 * Государственный регистрационный номер записи, вносимой в Единый государственный реестр
 * индивидуальных предпринимателей, состоит из 15 знаков, расположенных в следующей последовательности:
 * - С Г Г К К Х Х Х Х Х Х Х Х Х Ч
 * где:
 * - С (1-й знак) - признак отнесения государственного регистрационного номера записи:
 *   - к основному государственному регистрационному номеру записи о государственной регистрации
 *     индивидуального предпринимателя (ОГРНИП) - 3;
 *   - к иному государственному регистрационному номеру записи - 4;
 * - Г и Г (2-й и 3-й знаки) - две последние цифры года внесения записи в государственный реестр;
 * - К и К (4-й и 5-й знаки) - кодовое обозначение субъекта Российской Федерации, установленное
 *   МНС России в соответствии с федеративным устройством Российской Федерации, определенным статьей
 *   65 Конституции Российской Федерации;
 * - Х - Х (6-й - 14-й знаки) - номер записи, внесенной в государственный реестр в течение года;
 * - Ч (15-й знак) - контрольное число: младший разряд остатка от деления предыдущего 14-значного
 *   числа на 13.
 *
 * @category PHP
 * @package  Ybelenko\Ogrn
 * @author   Yuriy Belenko <yura-bely@mail.ru>
 * @license  MIT https://github.com/ybelenko/ogrn/blob/master/LICENSE
 * @version  Release: @package_version@
 * @link     https://github.com/ybelenko/ogrn
 */
 
class Ogrnip
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
        if (preg_match('/^\d{15}$/', $id) !== 1 || intval($identifier) <= 0) {
            return false;
        }
        // remainder after division
        $rem = gmp_intval( gmp_mod( substr($id, 0, -1), 13 ) );
        if (gmp_cmp($rem, 9) === 1) {
            $rem -= 10;
        }
        // control number
        $con = substr($id, -1);
        return (bool)(strval($rem) === $con);
    }
}
