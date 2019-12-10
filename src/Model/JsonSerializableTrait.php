<?php
/**
 * User: boshurik
 * Date: 09.12.19
 * Time: 20:02
 */

namespace BoShurik\OrangeData\Model;

trait JsonSerializableTrait
{
    public function jsonSerialize()
    {
        return array_filter(array_map(function ($value) {
            if ($value instanceof \JsonSerializable) {
                return $value->jsonSerialize();
            }
            if (is_iterable($value)) {
                $first = current($value);
                if ($first instanceof \JsonSerializable) {
                    return array_map(function (\JsonSerializable $value) {
                        return $value->jsonSerialize();
                    }, $value);
                }
            }

            return $value;
        }, get_object_vars($this)), function ($value) {
            return $value !== null;
        });
    }
}
