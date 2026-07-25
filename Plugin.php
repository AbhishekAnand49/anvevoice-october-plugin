<?php namespace Anvevoice\Voicewidget;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'AnveVoice — Voice AI for Websites',
            'description' => 'Add a real-time AI voice agent to your October CMS website in minutes. Supports 50+ languages. No coding required.',
            'author'      => 'AnveVoice',
            'icon'        => 'icon-microphone',
            'homepage'    => 'https://anvevoice.app'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'AnveVoice Settings',
                'description' => 'Configure your AnveVoice voice widget.',
                'category'    => 'AnveVoice',
                'icon'        => 'icon-microphone',
                'class'       => 'Anvevoice\Voicewidget\Models\Settings',
                'order'       => 500,
                'keywords'    => 'anvevoice voice ai widget',
                'permissions' => ['anvevoice.voicewidget.access_settings']
            ]
        ];
    }

    public function boot()
    {
        \Event::listen('cms.page.render', function($controller, $page) {
            $settings = \Anvevoice\Voicewidget\Models\Settings::instance();
            $embedId  = $settings->embed_id;

            if (empty($embedId)) {
                return;
            }

            $position = $settings->position ?: 'bottom-right';
            $theme    = $settings->theme ?: 'light';

            $script = sprintf(
                '<script src="https://api.anvevoice.app/functions/v1/voice-assistant-embed-js?embedId=%s&position=%s&theme=%s" async></script>',
                htmlspecialchars($embedId, ENT_QUOTES),
                htmlspecialchars($position, ENT_QUOTES),
                htmlspecialchars($theme, ENT_QUOTES)
            );

            return $script;
        });
    }
}
