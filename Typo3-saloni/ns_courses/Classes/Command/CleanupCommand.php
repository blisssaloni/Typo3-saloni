<?php
namespace NITSAN\NsCourses\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;

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
            ->setDescription('Soft delete records older than X days')
            ->addOption('days', null, InputOption::VALUE_REQUIRED, 'Mark records older than X days as deleted', 30);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $days = (int) $input->getOption('days');

        // Define the cutoff timestamp
        $cutoffTimestamp = (new \DateTimeImmutable())->modify("-$days days")->getTimestamp();

        // Get DB connection
        $connection = $this->connectionPool->getConnectionForTable('tx_nscourses_domain_model_students');
        $qb         = $connection->createQueryBuilder();

        // aa soft delete mate che and so we UPDATE and set deleted=1
        $qb->update('tx_nscourses_domain_model_students')
            ->set('deleted', 1)
            ->where(
                $qb->expr()->lt('crdate', $qb->createNamedParameter($cutoffTimestamp))
            )
            ->andWhere(
                $qb->expr()->eq('deleted', $qb->createNamedParameter(0, \PDO::PARAM_INT))
            );

        // Execute and count updated rows
        $affectedRows = $qb->executeStatement();

        $output->writeln("Soft deleted $affectedRows records older than $days days.");

        return Command::SUCCESS;
    }
}
