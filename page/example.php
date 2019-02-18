<?php

namespace Page;

class Example extends \Page\Page
{

    public function onCreate()
    {
        return new \View\Div('divLegal', 'Example');
    }

    public function verifyPermission($event = NULL)
    {
        return TRUE;
    }

}
