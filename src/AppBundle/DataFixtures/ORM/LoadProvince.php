<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 27/10/16
 * Time: 23:42
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Province;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadProvince
 * @package AppBundle\DataFixtures\ORM
 */
class LoadProvince extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var
     */
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
            'Álava',
            'Albacete',
            'Alicante',
            'Almería',
            'Ávila',
            'Badajoz',
            'Baleares (Illes)',
            'Barcelona',
            'Burgos',
            'Cáceres',
            'Cádiz',
            'Castellón',
            'Ciudad Real',
            'Córdoba',
            'A Coruña',
            'Cuenca',
            'Girona',
            'Granada',
            'Guadalajara',
            'Guipúzcoa',
            'Huelva',
            'Huesca',
            'Jaén',
            'León',
            'Lleida',
            'La Rioja',
            'Lugo',
            'Madrid',
            'Málaga',
            'Murcia',
            'Navarra',
            'Ourense',
            'Asturias',
            'Palencia',
            'Las Palmas',
            'Pontevedra',
            'Salamanca',
            'Santa Cruz de Tenerife',
            'Cantabria',
            'Segovia',
            'Sevilla',
            'Soria',
            'Tarragona',
            'Teruel',
            'Toledo',
            'Valencia',
            'Valladolid',
            'Vizcaya',
            'Zamora',
            'Zaragoza',
            'Ceuta',
            'Melilla',
        );

        $cont = 1;
        foreach ($names as $name) {
            $entity = new Province();
            $entity->setName($name);
            $slug = $this->container->get('sonata.core.slugify.cocur')->slugify($name, '-');
            $entity->setSlug($slug);
            $code = ($cont < 10) ? '0'.$cont : (string)$cont;
            $entity->setCode($code);

            $manager->persist($entity);
            $cont++;
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
        return 160;
    }
}