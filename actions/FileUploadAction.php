<?php

namespace yii\redactor\actions;

use Yii;
use yii\base\Action;
use yii\redactor\models\FileUploadModel;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 * @modified date 21 May 2018, 12:31 WIB
 * @modified by Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @link https://github.com/ommu/yii2-redactor
 */
class FileUploadAction extends Action
{
    function run()
    {
        if (isset($_FILES)) {
            $model = new FileUploadModel();
            if ($model->upload()) {
                return $model->getResponse();
            } else {
                return ['error' => 'Unable to save file'];
            }
        }
    }

}
