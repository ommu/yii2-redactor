<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\actions;

use Yii;
use yii\web\HttpException;
use yii\helpers\FileHelper;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 * @modified date 21 May 2018, 12:31 WIB
 * @modified by Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @link https://github.com/ommu/yii2-redactor
 */
class ImageManagerJsonAction extends \yii\base\Action
{
    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
    }

    public function run()
    {
        $onlyExtensions = array_map(function ($ext) {
            return '*.' . $ext;
        }, Yii::$app->controller->module->imageAllowExtensions);
        $filesPath = FileHelper::findFiles(Yii::$app->controller->module->getSaveDir(), [
            'recursive' => true,
            'only' => $onlyExtensions
        ]);
        if (is_array($filesPath) && count($filesPath)) {
            $result = [];
            foreach ($filesPath as $filePath) {
                $url = Yii::$app->controller->module->getUrl(pathinfo($filePath, PATHINFO_BASENAME));
                $result[] = ['thumb' => $url, 'image' => $url, 'title' => pathinfo($filePath, PATHINFO_FILENAME)];
            }
            return $result;
        }
    }

}
