<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 28/10/16
 * Time: 0:01
 */

namespace AppBundle\Command\Migrate;

use AppBundle\Entity\Geolocation;
use Ddeboer\DataImport\Reader\CsvReader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class LoadGeolocationFromCsvCommand
 * @package AppBundle\Command\Migrate
 */
class LoadGeolocationFromCsvCommand extends ContainerAwareCommand
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
    const LOG_FILENAME = 'load_geolocation_from_command.log';

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
            ->setName('migrate:geolocation:load-from-csv')
            ->setDescription('Carga datos a geolocation desde csv interno')
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


        // country
        $countries = array();
        $query = $this->em->getRepository('AppBundle:Country')
            ->createQueryBuilder('c')
            ->getQuery();
        $iterableResult = $query->iterate();
        foreach ($iterableResult as $row) {
            $country = $row[0];
            $countries[$country->getSlug()] = $country;
        }

        // province
        $provinces = array();
        $query = $this->em->getRepository('AppBundle:Province')
            ->createQueryBuilder('p')
            ->getQuery();
        $iterableResult = $query->iterate();
        foreach ($iterableResult as $row) {
            $province = $row[0];
            $provinces[(string)$province->getCode()] = $province;
        }

        // postal code
        $postalCodes = array();
        $query = $this->em->getRepository('AppBundle:PostalCode')
            ->createQueryBuilder('pc')
            ->getQuery();
        $iterableResult = $query->iterate();
        foreach ($iterableResult as $row) {
            $postalCode = $row[0];
            $postalCodes[$postalCode->getCode()] = $postalCode;
        }

        // municipality
        $municipalities = array();
        $query = $this->em->getRepository('AppBundle:Municipality')
            ->createQueryBuilder('m')
            ->getQuery();
        $iterableResult = $query->iterate();
        foreach ($iterableResult as $row) {
            $municipality = $row[0];
            $municipalities[$municipality->getName()] = $municipality;
        }

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

        $geolocationLen = 0;    // contador de usuarios modificados



        // recorre csv
        foreach ($reader as $row) {

            var_dump($row['cod_provinciaa']);



            // linea csv
            $line = $reader->key()+1;

            if ($geolocationLen == 3) die();

            $test = $row;
            $geolocationLen++;
        }

        //$this->em->flush();

        $output->writeln('Se ha generado correctamente las inserciones de geolocation segun el csv');
        $message = sprintf('Numero de geolocations creados: %d', $geolocationLen);
        $output->writeln($message);
        $logDump .= $message."\n";
        $this->fs->dumpFile($logPath, $logDump);
    }
}