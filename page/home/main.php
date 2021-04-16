<?php

namespace Page\Home;

class Main extends \Page\Page
{

    public function onCreate()
    {
        $this->setLayoutFile('page/home/main');

        $this->getMainDiv()->html('Dinamic content');

        $input = new \View\Input('id', \View\InputText::TYPE_TEXT, 'valor', 'span3');

        $this->getMainDiv()->append($input);
    }

    public function verifyPermission($event = NULL)
    {
        return TRUE;
    }

    public function sair()
    {
        \DataHandle\Session::getInstance()->destroy();
        \App::redirect(\DataHandle\Server::getInstance()->getHost());
    }

}
