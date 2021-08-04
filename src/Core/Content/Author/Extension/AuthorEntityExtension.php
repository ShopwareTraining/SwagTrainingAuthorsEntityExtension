<?php declare(strict_types=1);

namespace SwagTraining\AuthorsEntityExtension\Core\Content\Author\Extension;

use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Runtime;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use SwagTraining\AuthorsCore\Core\Content\Author\AuthorEntity;

class AuthorEntityExtension extends EntityExtension
{
    public const EXTENSION_NAME_NUMBER_OF_BOOKS = 'numberOfBooks';

    public function getDefinitionClass(): string
    {
        return AuthorEntity::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $numberOfBooksField = (new StringField(self::EXTENSION_NAME_NUMBER_OF_BOOKS, 'numberOfBooks'))
            ->addFlags(new Runtime());
        $collection->add($numberOfBooksField);
    }


}
