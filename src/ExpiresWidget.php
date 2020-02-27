<?php
/**
 * Expires Widget plugin for Craft CMS 3.x
 *
 * Widget that shows entries about to expire
 *
 * @link      https://solvr.no
 * @copyright Copyright (c) 2020 Johannes Arnstad
 */

namespace solvras\expireswidget;

use solvras\expireswidget\widgets\ExpiresWidgetWidget as ExpiresWidgetWidgetWidget;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Dashboard;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class ExpiresWidget
 *
 * @author    Johannes Arnstad
 * @package   ExpiresWidget
 * @since     0.1.0
 *
 */
class ExpiresWidget extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ExpiresWidget
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '0.1.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Dashboard::class,
            Dashboard::EVENT_REGISTER_WIDGET_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = ExpiresWidgetWidgetWidget::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'expires-widget',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
