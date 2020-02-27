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
use solvras\expireswidget\assetbundles\expireswidget\ExpiresWidgetAsset;

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

    public $numberOfArticles = 10;
    public $daysBeforeExpire = 7;

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
        return Craft::getAlias("@solvras/expireswidget/assetbundles/expireswidget/dist/img/ExpiresWidgetWidget-icon.svg");
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
                ['numberOfArticles', 'integer'],
                ['numberOfArticles', 'default', 'value' => 10]
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
        Craft::$app->getView()->registerAssetBundle(ExpiresWidgetAsset::class);

        return Craft::$app->getView()->renderTemplate(
            'expires-widget/_components/widgets/ExpiresWidgetWidget_body',
            [
                'numberOfArticles' => $this->numberOfArticles,
                'daysBeforeExpire' => $this->daysBeforeExpire,
                'entries' => $this->entriesToExpire($this->daysBeforeExpire, $this->numberOfArticles)
            ]
        );
    }

    public function entriesToExpire($expiresInDays, $limit)
    {

        $expiryDate = (new \DateTime('NOW'))->modify('+ ' . $expiresInDays . ' days')->format(\DateTime::ATOM);

        $expiredEntriesQuery = \craft\elements\Entry::find()
            ->expiryDate("< {$expiryDate}")
            ->limit($limit)
            ->orderBy('expiryDate ASC');

        $result = $expiredEntriesQuery->all();

        return $result;
    }
}
