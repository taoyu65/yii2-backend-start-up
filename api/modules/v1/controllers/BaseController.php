<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * @param bool $bool
     * @param $message
     * @param $content
     * @return string
     */
    protected function setReturn(bool $bool, $message = '', $content = [])
    {
        if ($bool) {
            $re = ['status' => 'success'];
        } else {
            $re = ['status' => 'error'];
        }

        $re['message'] = $message;
        $re['content'] = $content;

        return json_encode($re);
    }
}