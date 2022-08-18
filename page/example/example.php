<?php

namespace Page\Example;

class Example extends \Page\Page
{

    public function __construct()
    {
        parent::__construct();
        \Log::debug($_REQUEST);
    }

    public function verifyPermission($event = NULL)
    {
        return TRUE;
    }

    public function onCreate()
    {
        $event = $this->getEvent();
        $value = \DataHandle\Request::get('v');

        $content = [];

        $input = new \View\Input('valor', \View\InputText::TYPE_TEXT, \DataHandle\Request::get('valor'), 'span3');
        $input->blur('meClique');
        $input->css('float', 'left');

        $this->fundo();

        $content[] = $input;

        $content[] = new \View\Ext\DateInput('dado', \Type\DateTime::now());

        $content[] = new \View\Button('btnButton', 'Me clique', 'meClique', 'span3');

        $content[] = new \View\Div('divLegal', 'Event=' . $event . ' Value=' . $value);

        return $content;
    }

    public function meClique()
    {
        \App::dontChangeUrl();
        $this->fundo();

        $content = [];
        $content[] = new \View\Hr();
        $content[] = new \View\Fieldset('field');

        $content[] = new \View\Button('btnButton2', 'Me clique2', 'meClique2', 'span3');

        $this->byId('divLegal')->append($content);
    }

    public function meClique2()
    {
        alert('meCLique2');
    }

    private function fundo()
    {
        $valor = \DataHandle\Request::get('valor');

        if ($valor == 'fundo')
        {
            $this->byId('valor')->css('background-color', 'blue');
        }
    }

    public function event2()
    {
        alert(\DataHandle\Request::get('v'));
    }

    public function event()
    {
        $event = $this->getEvent();
        $value = \DataHandle\Request::get('v');

        return new \View\Div('divLegal', 'Event=' . $event . ' Value=' . $value);
    }

}
