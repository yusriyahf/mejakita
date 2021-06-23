<?php

namespace App\Controllers;

use App\Models\CalendarModel;

class myfullcalendar extends BaseController
{
    protected $calendarModel;
    public function __construct()
    {
        $this->calendarModel = new CalendarModel();
    }

    public function index()
    {
        $event_data = $this->calendarModel->findAll();
        foreach ($event_data as $row) {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'keterangan' => $row['keterangan'],
                'start' => $row['start_event'],
                'end' => $row['end_event']
            );
        }


        return view('home');
    }

    // public function load()
    // {
    //     $event_data = $this->calendarModel->findAll();
    //     foreach ($event_data as $row) {
    //         $data[] = array(
    //             'id' => $row['id'],
    //             'title' => $row['title'],
    //             'keterangan' => $row['keterangan'],
    //             'start' => $row['start_event'],
    //             'end' => $row['end_event']
    //         );
    //     }
    // }
}
