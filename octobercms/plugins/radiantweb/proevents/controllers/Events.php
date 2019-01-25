<?php namespace Radiantweb\Proevents\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Radiantweb\Proevents\Models\Event;
use Flash;
use Radiantweb\Proevents\Models\Settings as ProeventsSettingsModel;
use Radiantweb\Proevents\Models\GeneratedDate as GeneratedDateModel;

class Events extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Radiantweb.Proevents', 'proevents', 'events');
    }

    public function listInjectRowClass($model, $definition)
    {
        $settings = ProeventsSettingsModel::instance();
        $PE_DATE_GENERIC = ($settings->get('pe_date_generic')) ? $settings->get('pe_date_generic') : 'Y-m-d';
        $PE_DATE_SPOKEN = ($settings->get('pe_date_spoken')) ? $settings->get('pe_date_spoken') : 'l M jS, Y';
        $PE_DATE_TIME = ($settings->get('pe_date_time')) ? $settings->get('pe_date_time') : 'g:i a';

		$model->date_formatting = $PE_DATE_SPOKEN;
		$model->time_formatting = $PE_DATE_TIME;
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            $plural = null;
            if (count($checkedIds) > 1) {
                $plural = 's';
            }
            foreach ($checkedIds as $eventId) {
                if (!$event = Event::find($eventId)) continue;

                $event->delete();
            }

            Flash::success('Event'.$plural.' Successfully Deleted.');
        }

        return $this->listRefresh();
    }
}
