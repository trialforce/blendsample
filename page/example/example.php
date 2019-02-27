<?php

namespace Page\Example;

class Example extends \Page\Page
{

    public function __construct()
    {
        parent::__construct();
    }

    public function onCreate()
    {
        $event = $this->getEvent();
        $value = \DataHandle\Request::get('v');

        return new \View\Div('divLegal', 'Event=' . $event . ' Value=' . $value);
    }

    public function verifyPermission($event = NULL)
    {
        return TRUE;
    }

    public function event()
    {
        $event = $this->getEvent();
        $value = \DataHandle\Request::get('v');

        return new \View\Div('divLegal', 'Event=' . $event . ' Value=' . $value);
    }

}
