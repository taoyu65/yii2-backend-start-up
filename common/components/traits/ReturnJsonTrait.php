<?php

namespace common\components\traits;

trait ReturnJsonTrait
{
    /**
     * @param bool $bool
     * @param string $errorMessage
     * @param array $arr
     * @return array
     */
    protected function setReturn($bool, $errorMessage = '', $arr = [])
    {
        if ($bool) {
            $re = ['status' => 'success'];
        } else {
            $re = ['status' => 'error'];
        }
        if ($errorMessage) {
            $re['errorMessage'] = $errorMessage;
        }
        foreach ($arr as $title => $item) {
            $re[$title] = $item;
        }

        return $re;
    }
}