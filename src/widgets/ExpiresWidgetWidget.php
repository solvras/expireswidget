<?php
/**
 * Expires Widget plugin for Craft CMS 3.x
 *
 * Widget that shows entries about to expire
 *
 * @link      https://solvr.no
 * @copyright Copyright (c) 2020 Johannes Arnstad
 */

namespace solvras\expireswidget\widgets;

use solvras\expireswidget\ExpiresWidget;
use solvras\expireswidget\assetbundles\expireswidgetwidgetwidget\ExpiresWidgetWidgetWidgetAsset;

use Craft;
use craft\base\Widget;

/**
 * Expires Widget Widget
 *
 * @author    Johannes Arnstad
 * @package   ExpiresWidget
 * @since     0.1.0
 */
class ExpiresWidgetWidget extends Widget
{

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $message = 'Hello, world.';

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('expires-widget', 'ExpiresWidgetWidget');
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        return Craft::getAlias("@solvras/expireswidget/assetbundles/expireswidgetwidgetwidget/dist/img/ExpiresWidgetWidget-icon.svg");
    }

    /**
     * @inheritdoc
     */
    public static function maxColspan()
    {
        return null;
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge(
            $rules,
            [
                ['message', 'string'],
                ['message', 'default', 'value' => 'Hello, world.'],
            ]
        );
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate(
            'expires-widget/_components/widgets/ExpiresWidgetWidget_settings',
            [
                'widget' => $this
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getBodyHtml()
    {
        Craft::$app->getView()->registerAssetBundle(ExpiresWidgetWidgetWidgetAsset::class);

        return Craft::$app->getView()->renderTemplate(
            'expires-widget/_components/widgets/ExpiresWidgetWidget_body',
            [
                'message' => $this->message
            ]
        );
    }
}
