<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 15/10/16
 * Time: 15:48
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\BankAwarded;
use AppBundle\Entity\Type;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadBankAwarded extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Ahorro Corporación',
            'Banca March/ Bancamarch',
            'Bancaja / Bancajahabitat',
            'Banco Caixa Geral / Inmocaixageral',
            'Banco de Valencia',
            'Banco Guipuzcoano / Inmobicoaria',
            'Banco Herrero / Solvia',
            'Banco MareNostrum / BMN',
            'Banco Pastor / Inmoseleccion',
            'Banco Popular / Ges Aliseda',
            'Banco Sabadell / Solvia',
            'Banco Santander / Altamira santander',
            'Banesto / Inmobihtaria',
            'Bankia / Aktua',
            'Bankia / Haya Real State',
            'Bankia / Sareb',
            'Bankinter',
            'Barclays / Aberis',
            'BBVA / Atrea',
            'BBVA Vivienda / Anida',
            'BNP',
            'Caixa Catalunya / Procam',
            'Caixa Galicia / Cxginmobiliaria',
            'Caixa Girona / CaixaGirona',
            'Caixa Manresa / Procam',
            'Caixa Nova / Proinova',
            'Caixa Penedès / Revalua',
            'Caixa Sabadell / Unnimcasa',
            'Caixa Terrassa / Unnimcasa',
            'Caja Canarias / Incavesa',
            'Caja Cantabria / Cajacantabria',
            'Caja Círculo / Cajacirculo',
            'Caja de Burgos / Cajadeburgos',
            'Caja de Jaén / Cajaen',
            'Caja Duero / Giasainversiones',
            'Caja España / Caja España',
            'Caja Granada / Caja Inmobiliaria',
            'Caja Guadalajara / Cajaguadalajara',
            'Caja Inmaculada / Caiencasa',
            'Caja Mediterráneo / Caja Ascam',
            'Caja Mediterráneo / CAM',
            'Caja Murcia / Caja Tex',
            'Caja Navarra / Caja Navarra',
            'Caja Segovia / Edictaservicios',
            'Caja Vital Kutxa / Cajavital',
            'Cajalón / Ruralvia',
            'Cajamar / Cimenta2',
            'Cajas Rurales / Ruralvia',
            'Cajasol',
            'Cajastur / Enobranueva',
            'Cajasur Inmobiliaira',
            'CatalunyaCaixa / Cxinmobiliaria',
            'Citibank',
            'Credit Agricole',
            'CRM Caja Rural del Mediterráneo',
            'Deutsche Bank / Deutsche Bank',
            'General Electric',
            'GMAC',
            'Halifax Idealista',
            'Ibercaja',
            'Kutxa / Aiksa',
            'La Caixa / Servihabitat',
            'La Caja de Canarias',
            'NovaCaixaGalicia / Escogecasa',
            'Sa Nostra / Netmobilia',
            'UCI – Unión de Créditos Inmobiliarios / Inmoos',
            'Unicaja Inmuebles',
            'Unnim / Unnimcasa',
            'Otra',
        );

        $numOrder = 1;
        foreach ($names as $name) {
            $entity = new BankAwarded();
            $entity->setName($name);
            $slug = $this->container->get('sonata.core.slugify.cocur')->slugify($name, '-');
            $entity->setSlug($slug);
            $entity->setNumOrder($numOrder);

            $manager->persist($entity);
            $numOrder++;
        }

        $manager->flush();
    }


    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 30;
    }
}