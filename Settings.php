<?php namespace Anvevoice\Voicewidget\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'anvevoice_voicewidget_settings';

    public $settingsFields = 'fields.yaml';
}
