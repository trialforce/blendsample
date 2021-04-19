<?php

use DataHandle\Config;
use DataHandle\Session;
use DataHandle\Request;

class Sample extends \View\Layout
{

    public function __construct()
    {
        parent::__construct();
        Config::set('response', 'content');
        \View\View::setDom($this);
    }

    public function onCreate()
    {
        parent::onCreate();

        if (Session::get('user'))
        {
            $this->onLogged();
        }
        else
        {
            $this->onLogin();
        }
    }

    public function onLogged()
    {
        $this->setLayoutFile('page\base');
        $this->addCssJs();

        $nav = $this->getElementsByTagName('nav')->item(0);
        $nav = new View\DomContainer($nav);

        $modules['home/main'] = '<i class="fa fa-user">&nbsp;</i>Main';
        $modules['home/cliente'] = '<i class="fa fa-user">&nbsp;</i>Cliente';
        $submenu['example/example/event/pk'] = '<i class="fa fa-user">&nbsp;</i>Example';
        $modules['submenu'] = array('<i class="fa fa-user">&nbsp;</i>Sub-menu', $submenu);
        $modules['example/example/event/otherpk'] = '<i class="fa fa-user">&nbsp;</i>Example';
        $modules['home/main/sair'] = '<i class="fa fa-sign-out">&nbsp;</i>Sair';

        $nav->append(new \View\Ext\Menu('menuzao', $modules));
    }

    public function onLogin()
    {
        $this->setLayoutFile('page\login');
        $this->addCssJs();
        $this->addStyleShet('loginstyle', 'assets/login.css');
        $this->byId('user')->setValue(Request::get('user'));

        if (Request::get('login') !== NULL)
        {
            $this->login(Request::get('user'), Request::get('password'));
        }

        $this->setBaseUrl();
    }

    public function addCssJs()
    {
        $optimizer = new \Misc\Optimizer(\Disk\File::getFromStorage('azata.js')); //, '\Misc\JsMin');
        $optimizer->addFile(BLEND_PATH . '/js/jquery.min.js');
        $optimizer->addFile(BLEND_PATH . '/js/jquery.autonumeric.js');
        $optimizer->addFile(BLEND_PATH . '/js/jquery.mask.js');
        $optimizer->addFile(BLEND_PATH . '/js/jquery.datetimepicker.js');
        $optimizer->addFile(BLEND_PATH . '/js/nicedit.js');
        $optimizer->addFile(BLEND_PATH . '/js/shortcut.js');
        $optimizer->addFile(BLEND_PATH . '/js/blend.js');

        foreach (\Disk\File::find(BLEND_PATH . '/js/blend/*.js') as $fileJs)
        {
            $optimizer->addFile($fileJs);
        }

        $optimizer->addFile(BLEND_PATH . '/js/plugin/blend.grownumber.js');
        $optimizer->addFile(BLEND_PATH . '/js/dropzone.js');

        $output = $optimizer->execute();

        $script = new \View\Script($output->getUrl(), null, \View\Script::TYPE_JAVASCRIPT, false);
        $this->getHtml()->appendChild($script);

        $this->addStyleShet('base', BLEND_PATH . '/base.css', NULL, FALSE);
        $this->addStyleShet('main', 'assets/sample.css');
        $this->addStyleShet('fontawesome', 'assets/font-awesome.min.css');
    }

    protected function login($user, $password)
    {
        if (!$user || !$password)
        {
            $this->byId('error')->show();
        }
        else
        {
            Session::set('user', 1);
            \App::refresh();
        }
    }

}
