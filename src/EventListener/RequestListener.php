<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        if ($request->getContentType() == 'json') {
            $data = json_decode($request->getContent(), true);
            $request->request->replace($data);
        }
    }
}
