<?php
namespace NITSAN\NsCourses\Command;

use TYPO3\CMS\Core\Database\ConnectionPool;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanupCommand extends Command
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Deletes records older than X days')
            ->addOption('days', null, InputOption::VALUE_REQUIRED, 'Delete records older than X days', 30);
    }

protected function execute(InputInterface $input, OutputInterface $output): int
{
    $days = (int) $input->getOption('days');
    
    // Define the cutoff timestamp
    $cutoffTimestamp = (new \DateTimeImmutable())->modify("-$days days")->getTimestamp();

    // Get DB connection
    $connection = $this->connectionPool->getConnectionForTable('tx_nscourses_domain_model_students');
    $qb = $connection->createQueryBuilder();

    // Build delete query
    $qb->delete('tx_nscourses_domain_model_students')
        ->where(
    $qb->expr()->lt('crdate', $qb->createNamedParameter($cutoffTimestamp))
);


    // Execute and count deleted rows
    $deletedRows = $qb->executeStatement();

    $output->writeln("Deleted $deletedRows records older than $days days.");

    return Command::SUCCESS;
}

 }
