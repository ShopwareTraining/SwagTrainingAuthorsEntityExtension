<?php declare(strict_types=1);

namespace SwagTraining\AuthorsEntityExtension\Subscriber;

use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\Struct\ArrayEntity;
use SwagTraining\AuthorsCore\Core\Content\Author\AuthorEntity;
use SwagTraining\AuthorsEntityExtension\Core\Content\Author\Extension\AuthorEntityExtension;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AuthorEntityExtensionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return ['author.loaded' => 'onAuthorLoad'];
    }

    public function onAuthorLoad(EntityLoadedEvent $event): void
    {
        /** @var AuthorEntity $author */
        foreach ($event->getEntities() as $author) {
            $extension = new ArrayEntity(['number' => random_int(1, 10)]);
            $author->addExtension(AuthorEntityExtension::EXTENSION_NAME_NUMBER_OF_BOOKS, $extension);
        }

    }


}
