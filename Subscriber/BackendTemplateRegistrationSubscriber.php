<?php

namespace PSC7Helper\Subscriber;

use Enlight\Event\SubscriberInterface;

class BackendTemplateRegistrationSubscriber implements SubscriberInterface
{
    /**
     * @var string
     */
    private $templateDirectory;

    public function __construct(string $templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch' => 'onBackendPostDispatch'
        ];
    }

    public function onBackendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->getSubject();
        $request = $args->getRequest();
        $view = $controller->View();

        if ($request->getModuleName() !== 'backend') {
            return;
        }

        $view->addTemplateDir($this->templateDirectory);
    }
}