<?php namespace Radiantweb\Proevents\Models;

use Str;
use DB;
use Model;
use October\Rain\Database\ModelException;
use Radiantweb\Proevents\Models\Settings as ProeventsSettingsModel;

class GeneratedDate extends Model
{
    public $table = 'radiantweb_generated_dates';

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $date;
    public $time;

    /**
     * @var array Attributes that support translation, if available.
     */
     public $translatable = [
         'title',
         'excerpt',
         'content'
     ];

    /*
     * Validation
     */
    public $rules = [];

    protected $guarded = [];

    /*
     * Relations
     */
    public $belongsTo = [
        'event' => ['Radiantweb\Proevents\Models\Event'],
		'calendars' => ['Radiantweb\Proevents\Models\Calendar', 'table'=> 'radiantweb_events_calendars', 'key' => 'event_id']
    ];
    
    public function beforeSave()
    {
        $this->sttime = date('H:i:s',strtotime($this->sttime));
        $this->entime = date('H:i:s',strtotime($this->entime));
        $this->event_qty = $this->event_qty?$this->event_qty:0;
    }

    public function setDateTime()
    {
        $settings = ProeventsSettingsModel::instance();
        $dropoff = $settings->get('pe_dropoff');

        $date = date("Y-m-d");
        $time = date("H:i:s");
        
        if($dropoff) {
            $hms = explode(':',$dropoff);
            $backDated = date("Y-m-d H:i:s", strtotime("-$hms[0] Hours -$hms[1] Minutes -$hms[2] Seconds",strtotime($date . " " .$time)));
            $backDatedCombined = explode(' ',$backDated);
            $date = $backDatedCombined[0];
            $time = $backDatedCombined[1];
        }

        $this->date = $date;
        $this->time = $time;
    }


    /*
     * Get specific calendar event dates by month for calendar views
     */
    public function getCalendarEvents($month,$calendar_ids=null)
    {
        if($calendar_ids){
            $events = GeneratedDate
                ::whereRaw($calendar_ids)
                ->whereRaw("DATE_FORMAT(event_date,'%m') = $month")
                ->orderBy('event_date')
                ->orderBy('sttime','asc')
                ->get()->all();
        }else{
            $events = GeneratedDate
                ::whereRaw("DATE_FORMAT(event_date,'%m') = $month")
                ->orderBy('event_date')
                ->orderBy('sttime','asc')
                ->get()->all();
        }

        return $events;
    }


    /*
     * Get specific calendar event dates by start-end for calendar views
     */
    public function getFromToCalendarEvents($start,$end,$calendar_ids=null)
    {
        if($calendar_ids){
            $events = GeneratedDate
                ::whereRaw($calendar_ids)
                ->whereRaw("DATE_FORMAT(event_date,'%Y-%m-%d') >= DATE_FORMAT('$start','%Y-%m-%d')")
                ->whereRaw("DATE_FORMAT(event_date,'%Y-%m-%d') <= DATE_FORMAT('$end','%Y-%m-%d')")
                ->orderBy('event_date')
                ->orderBy('sttime','asc')
                ->get()->all();
        }else{
            $events = GeneratedDate
                ::whereRaw("DATE_FORMAT(event_date,'%Y-%m-%d') >= DATE_FORMAT('$start','%Y-%m-%d')")
                ->whereRaw("DATE_FORMAT(event_date,'%Y-%m-%d') <= DATE_FORMAT('$end','%Y-%m-%d')")
                ->orderBy('event_date')
                ->orderBy('sttime','asc')
                ->get()->all();
        }

        return $events;
    }

    /*
     * Get specific calendar event dates by month for list views
     */
    public function getCalendarEventsList($calendar_ids=null,$num=null)
    {
        $this->setDateTime();

        $events = GeneratedDate
            ::whereRaw($calendar_ids)
            ->whereRaw("((event_date = ? AND sttime > ?) OR event_date > ?)", array($this->date,$this->time,$this->date))
            ->groupBy('event_id','grouped_id')
            ->orderBy('event_date')
            ->orderBy('sttime','asc')
            ->paginate($num);

        return $events;
    }


    /*
     * Get event dates by month for list views
     */
    public function getEventsList($num=null)
    {
        $this->setDateTime();

        $events = GeneratedDate
            ::groupBy('grouped_id','event_id')
            ->whereRaw("((event_date = ? AND sttime > ?) OR event_date > ?)", array($this->date,$this->time,$this->date))
            ->orderBy('event_date')
            ->orderBy('sttime','asc')
            ->paginate($num);

        return $events;
    }


    /*
     * Get grouped events for given eventID and groupID
     */
    public function getGroupedDates($event_id,$group)
    {
        return json_decode(GeneratedDate
                        ::where('event_id', '=', $event_id)
                        ->where('grouped_id', '=', $group)
                        ->orderBy('event_date')
                        ->orderBy('sttime','asc')
                        ->get());
    }

    /*
     * Check whether or not a given date has an event
     */
    public static function dayHasEvents($date,$calendar_ids=null)
    {
        if($calendar_ids){
            return GeneratedDate
                            ::whereRaw($calendar_ids)
                            ->whereRaw("DATE_FORMAT(event_date,'%Y-%m-%d') = DATE_FORMAT('$date','%Y-%m-%d')")
                            ->first();
        }else{
            return GeneratedDate
                            ::whereRaw("DATE_FORMAT(event_date,'%Y-%m-%d') = DATE_FORMAT('$date','%Y-%m-%d')")
                            ->first();
        }
    }
}
