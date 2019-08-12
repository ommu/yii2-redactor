<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\models;

use Yii;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 * @modified date 21 May 2018, 12:31 WIB
 * @modified by Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @link https://github.com/ommu/yii2-redactor
 */
class ImageUploadModel extends FileUploadModel
{
    public function rules()
    {
        return [
            ['file', 'file', 'extensions' => Yii::$app->controller->module->imageAllowExtensions]
        ];
    }

}