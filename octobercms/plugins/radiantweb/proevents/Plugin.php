<?php namespace Radiantweb\Proevents;

use Backend;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use Backend\Models\User as BackendUserModel;
use Radiantweb\Proevents\Models\Calendar;
use Event;

use Radiantweb\Proevents\Models\Event as Events;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'radiantweb.proevents::lang.plugin.name',
            'description' => 'radiantweb.proevents::lang.plugin.description',
            'author'      => '://radiantweb',
            'icon'        => 'icon-calendar-o'
        ];
    }

    public function boot()
    {
        Event::listen('pages.menuitem.listTypes', function() {
                return [
                    'proevents-calendar'=>'radiantweb.proevents::lang.menuitems.calendar',
                    'all-proevents-calendars'=>'radiantweb.proevents::lang.menuitems.allcalendars',
                ];
            });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
                if ($type == 'proevents-calendar' || $type == 'all-proevents-calendars')
                    return Calendar::getMenuTypeInfo($type);
            });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
                if ($type == 'proevents-calendar' || $type == 'all-proevents-calendars')
                    return Calendar::resolveMenuItem($item, $url, $theme);
            });

        Event::listen('offline.sitesearch.query', function ($query) {

            // Search your plugin's contents
            $items = Events::where('title', 'like', "%${query}%")
                ->orWhere('content', 'like', "%${query}%")
                ->get();

            // Now build a results array
            $results = $items->map(function ($item) use ($query) {

                // If the query is found in the title, set a relevance of 2
                $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;
            
                // Optional: Add an age penalty to older results. This makes sure that
                // never results are listed first.
                // if ($relevance > 1 && $item->published_at) {
                //     $relevance -= $this->getAgePenalty($item->published_at->diffInDays(Carbon::now()));
                // }

                return [
                    'title' => $item->title,
                    'text' => $item->content,
                    'url' => '/event/' . $item->slug . '/' . $item->id,
                    // 'thumb' => $item->images->first(), // Instance of System\Models\File
                    'relevance' => $relevance, // higher relevance results in a higher
                                           // position in the results listing
                // 'meta' => 'data',       // optional, any other information you want
                                           // to associate with this result
                // 'model' => $item,       // optional, pass along the original model
                ];
            });

            return [
                'provider' => 'Events', // The badge to display for this result
                'results' => $results,
            ];
        });
    }

    public function register ()
    {
        Event::listen('system.console.mirror.extendPaths', function($paths) {
            $paths->wildcards = array_merge($paths->wildcards, [
                'plugins/radiantweb/proevents/assets/*',
                'plugins/radiantweb/proevents/assets/*/*',
            ]);
        });
    }

    public function registerComponents()
    {
        return [
            'Radiantweb\Proevents\Components\Event' => 'proEvent',
            'Radiantweb\Proevents\Components\EventList' => 'proEventList',
            'Radiantweb\Proevents\Components\EventCalendar' => 'proEventCalendar',
        ];
    }

    public function registerPageSnippets()
    {
        return [
            'Radiantweb\Proevents\Components\EventList' => 'proEventList',
            'Radiantweb\Proevents\Components\EventCalendar' => 'proEventCalendar',
        ];
    }

    public function registerNavigation()
    {
        return [
            'proevents' => [
                'label'       => 'radiantweb.proevents::lang.plugin.name',
                'url'         => Backend::url('radiantweb/proevents/events'),
                'icon'        => 'icon-calendar',
                'permissions' => ['radiantweb.proevents.*'],
                'order'       => 500,

                'sideMenu' => [
                    'events' => [
                        'label'       => 'radiantweb.proevents::lang.sidemenu.events',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('radiantweb/proevents/events'),
                        'permissions' => ['radiantweb.proevents.access_events'],
                    ],
                    'generated_dates' => [
                        'label'       => 'radiantweb.proevents::lang.sidemenu.generated',
                        'icon'        => 'icon-list-alt',
                        'url'         => Backend::url('radiantweb/proevents/generated_dates'),
                        'permissions' => ['radiantweb.proevents.access_events'],
                    ],
                    'calendars' => [
                        'label'       => 'radiantweb.proevents::lang.sidemenu.calendars',
                        'icon'        => 'icon-calendar-o',
                        'url'         => Backend::url('radiantweb/proevents/calendars'),
                        'permissions' => ['radiantweb.proevents.access_calendars'],
                    ],
                ]

            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'radiantweb.proevents.access_calendars' => ['label' => 'radiantweb.proevents::lang.permissions.managecalendars', 'tab' => 'ProEvents'],
            'radiantweb.proevents.access_events' => ['label' => 'radiantweb.proevents::lang.permissions.manageevents', 'tab' => 'ProEvents'],
            'radiantweb.proevents.access_proevent_settings' => ['label' => 'radiantweb.proevents::lang.permissions.managesettings', 'tab' => 'ProEvents']
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'ProEvents',
                'description' => 'radiantweb.proevents::lang.settings.description',
                'icon'        => 'icon-calendar',
                'class'       => 'Radiantweb\Proevents\Models\Settings',
                'order'       => 100,
                'permissions' => ['radiantweb.proevents.access_proevent_settings']
            ]
        ];
    }

    public function registerFormWidgets()
	{
	    return [
	        'Radiantweb\Proevents\Modules\Backend\Formwidgets\Multidate' => [
	            'label' => 'MultiDate',
	            'code' => 'multidate'
	        ],
            'Radiantweb\Proevents\Modules\Backend\Formwidgets\Time' => [
                'label' => 'Time',
                'code' => 'time'
            ],
            'Radiantweb\Proevents\Modules\Backend\Formwidgets\Rcolorpicker' => [
                'label' => 'Colorpicker',
                'code' => 'rcolorpicker'
            ]
	    ];
	}

    public function registerMarkupTags()
    {
        // Check the translate plugin is installed
        $filters = array();
        if (!PluginManager::instance()->exists('RainLab.Translate')) {
            $filters['_'] = ['Lang', 'get'];
            $filters['__'] = ['Lang', 'choice'];
        }

        return [
            'functions' => [
                'getAuthorInfo' => [$this, 'getAuthorInfo']
            ],
            'filters' => $filters
        ];
    }
    

    public function getAuthorInfo($id)
    {
        $user = BackendUserModel::where('id',$id)->first();
        if($user->avatar){
            $user->image = $user->avatar->getThumb(100, 100, ['mode' => 'crop']);
        }
        return $user;
    }

}
