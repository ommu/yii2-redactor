<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 * @modified date 21 May 2018, 12:31 WIB
 * @modified by Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @link https://github.com/ommu/yii2-redactor
 */
class RedactorModule extends \yii\base\Module
{
    public $controllerNamespace = 'yii\redactor\controllers';
    public $defaultRoute = 'upload';
    public $subFolderName = 'redactor';
    public $uploadDir = '@webroot/uploads';
    public $uploadUrl = '@web/uploads';
    public $imageUploadRoute = ['/redactor/upload/image'];
    public $fileUploadRoute = ['/redactor/upload/file'];
    public $imageManagerJsonRoute = ['/redactor/upload/image-json'];
    public $fileManagerJsonRoute = ['/redactor/upload/file-json'];
    public $imageAllowExtensions = ['jpg', 'png', 'gif', 'bmp', 'svg'];
    public $fileAllowExtensions = null;
    public $widgetOptions=[];
    public $widgetClientOptions=[];


    public function getSubPath()
    {
        $request = Yii::$app->request;
        $ownerPath = $request->get('subfolder', $this->subFolderName);
        $ownerPath = preg_replace('/[^a-zA-Z]/', '', $ownerPath);
        if(!empty($ownerPath))
            $ownerPath = $ownerPath;

        return $ownerPath == $this->subFolderName ? $ownerPath : $this->subFolderName.'_'.$ownerPath;
    }

    /**
     * @return string
     * @throws InvalidConfigException
     * @throws \yii\base\Exception
     */
    public function getSaveDir()
    {
        $path = Yii::getAlias($this->uploadDir) . DIRECTORY_SEPARATOR . $this->getSubPath();
        if(!file_exists($path)){      
            if (!FileHelper::createDirectory($path, 0775, $recursive = true )) {
                throw new InvalidConfigException('$uploadDir does not exist and default path creation failed');
            }
        }
        return $path;
    }

    /**
     * @param $fileName
     * @return string
     * @throws InvalidConfigException
     */
    public function getFilePath($fileName)
    {
        return $this->getSaveDir() . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * @param $fileName
     * @return string
     */
    public function getUrl($fileName)
    {
        return Url::to($this->uploadUrl . DIRECTORY_SEPARATOR . $this->getSubPath() . DIRECTORY_SEPARATOR . $fileName);
    }
}
