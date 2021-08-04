<?php declare(strict_types=1);

namespace SwagTraining\AuthorsEntityExtension\Command;

use Exception;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use SwagTraining\AuthorsCore\Core\Content\Author\AuthorCollection;
use SwagTraining\AuthorsCore\Core\Content\Author\AuthorEntity;
use SwagTraining\AuthorsCore\Core\Content\Author\Extension\AuthorEntityExtension;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AuthorEntityExtensionCommand extends Command
{
    private EntityRepositoryInterface $authorEntityRepository;

    public function __construct(EntityRepositoryInterface $authorEntityRepository, string $name = null)
    {
        $this->authorEntityRepository = $authorEntityRepository;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('training:author:entity-extension');
        $this->setDescription('Renders the Number of Books of the first author entity');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $context = Context::createDefaultContext();
        $criteria = new Criteria();

        try {
            /** @var AuthorCollection $allAuthors */
            $allAuthors = $this->authorEntityRepository->search($criteria, $context);

            /** @var AuthorEntity $firstAuthor */
            $firstAuthor = $allAuthors->first();
            $prefix = 'Number of Books for ' . $firstAuthor->getName() . ': ';
            $numberOfBooksExtension = $firstAuthor->getExtension(AuthorEntityExtension::EXTENSION_NAME_NUMBER_OF_BOOKS);
            $output->writeln($prefix . $numberOfBooksExtension['number']);
        } catch (Exception $exception) {
            $output->writeln('<error>' . $exception->getMessage() . '</error>');
        }

        return 0;
    }

}
