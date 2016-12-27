<?php

namespace CodelyTv\Context\Video\Module\Notification\Domain\Send;

use CodelyTv\Context\Video\Module\Notification\Domain\Create\NotificationCreatedDomainEvent;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationId;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;

final class SendBusinessIntelligenceNotificationOnNotificationCreated
{
    private $sender;

    public function __construct(NotificationSender $sender)
    {
        $this->sender = $sender;
    }

    public static function subscribedTo(): array
    {
        return [NotificationCreatedDomainEvent::class];
    }

    public function __invoke(NotificationCreatedDomainEvent $event)
    {
        $text = new NotificationText($event->text());
        $type = new NotificationType($event->type());

        $this->sender->__invoke($text, $type);
    }
}
