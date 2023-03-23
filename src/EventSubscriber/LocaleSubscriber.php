<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    public const DEFAULT_LOCALE = "en";
    public const LOCALE_KEY = "_locale";

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $locale = $request->query->get(self::LOCALE_KEY);
        if ($locale !== null) {
            $request->getSession()->set(self::LOCALE_KEY, $locale);
        }
        $request->setLocale($request->getSession()->get(self::LOCALE_KEY, self::DEFAULT_LOCALE));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}