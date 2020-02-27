<?php
/**
 * Expires Widget plugin for Craft CMS 3.x
 *
 * Widget that shows entries about to expire
 *
 * @link      https://solvr.no
 * @copyright Copyright (c) 2020 Johannes Arnstad
 */

namespace solvras\expireswidget\assetbundles\expireswidget;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Johannes Arnstad
 * @package   ExpiresWidget
 * @since     0.1.0
 */
class ExpiresWidgetAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@solvras/expireswidget/assetbundles/expireswidget/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/ExpiresWidgetWidget.js',
        ];

        $this->css = [
            'css/ExpiresWidgetWidget.css',
        ];

        parent::init();
    }
}
