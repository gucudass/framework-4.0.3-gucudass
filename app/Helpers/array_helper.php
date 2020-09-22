<?php

if (! function_exists('array_key_pivot'))
{
    /**
     *
     * @param array $aArray
     * @param string $sKey
     * @param bool $bDuplicate
     * @return array|bool
     */
    function array_key_pivot(array $aArray, string $sKey, bool $bDuplicate = false)
    {
        if (is_array($aArray) !== true) return false;

        $aReturn = [];
        foreach ($aArray as $iKey => $aVal) {
            if (array_key_exists($sKey, $aVal) === true) {
                if ($bDuplicate === false) {
                    $aReturn[$aVal[$sKey]] = $aVal;
                } else {
                    $aReturn[$aVal[$sKey]][] = $aVal;
                }
            }
        }

        return $aReturn;
    }
}
