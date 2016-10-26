<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 18/10/16
 * Time: 22:30
 */

namespace AppBundle\Command\Migrate;

use AppBundle\Entity\Municipality;
use AppBundle\Entity\PostalCode;
use Ddeboer\DataImport\Reader\CsvReader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class LoadPostalCodeFromCsvCommand
 * @package AppBundle\Command\Migrate
 */
class LoadPostalCodeFromCsvCommand extends ContainerAwareCommand
{
    /**
     *
     */
    const CSV_DIR = 'uploads/command/migrate';

    /**
     *
     */
    const CSV_FILENAME = 'FicheroRelacion_INE_CodigoPostal.csv';

    /**
     *
     */
    const LOG_DIR = 'command/migrate';

    /**
     *
     */
    const LOG_FILENAME = 'load_postal_code_from_command.log';

    /**
     * @var
     */
    private $container;

    /**
     * @var
     */
    private $em;

    /**
     * @var
     */
    private $fs;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('migrate:postal-code:load-from-csv')
            ->setDescription('Carga datos desde csv interno')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->container = $this->getContainer();
        $this->em = $this->container->get('doctrine')->getManager();
        $this->fs = $this->container->get('filesystem');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('¿Continuar con la acción? (y, n) [y]: ', true);

        if (!$helper->ask($input, $output, $question)) {
            $output->writeln('Operación cancelada');
            return;
        }

        $output->writeln('Preparando...');

        ini_set('memory_limit', '-1');



        // ruta absoluta de fichero log
        $logPath = $this->container->get('kernel')->getLogDir().'/'.self::LOG_DIR.'/'.self::LOG_FILENAME;
        $logDump = '';

        // ruta absoluta /var/www/... del fichero csv
        $absoluteCSVFilePath = $this->getContainer()->get('kernel')
                ->getRootDir().'/../web/'.self::CSV_DIR.'/'.self::CSV_FILENAME;

        // trata csv
        $file = new \SplFileObject($absoluteCSVFilePath);
        // https://github.com/ddeboer/data-import#csvreader
        $reader = new CsvReader($file, ';');

        $reader->setHeaderRowNumber(0); // quita cabeceras

        $postalCodeLen = 0;    // contador de usuarios modificados

        $postalCodeNames = array();

        // recorre csv
        foreach ($reader as $row) {

            // linea csv
            $line = $reader->key()+1;

            $code = $row['cod_postal'];

            // si existe email de csv en usuarios
            if (!in_array($code, $postalCodeNames)) {

                $postalCode = new PostalCode();
                $postalCode->setCode($code);
                $this->em->persist($postalCode);

                $postalCodeNames[] = $code;

                $postalCodeLen++;
            }
            else {
                $message = sprintf('[Linea %d] Ya existe codigo postal con codigo: %s', $line, $code);
                $output->writeln($message);
                $logDump .= $message."\n";
            }

        }

        $this->em->flush();

        $output->writeln('Se ha generado correctamente la subida de csv');
        $message = sprintf('Numero de codigos postales creados: %d', $postalCodeLen);
        $output->writeln($message);
        $logDump .= $message."\n";
        $this->fs->dumpFile($logPath, $logDump);
    }

}