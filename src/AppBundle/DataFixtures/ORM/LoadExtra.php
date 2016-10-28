<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 27/10/16
 * Time: 22:35
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Extra;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadExtra
 * @package AppBundle\DataFixtures\ORM
 */
class LoadExtra extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        // types
        $types = array();
        $query = $manager->getRepository('AppBundle:Type')
            ->createQueryBuilder('t')
            ->getQuery();

        $iterableResult = $query->iterate();
        foreach ($iterableResult as $row) {
            $type = $row[0];
            $types[$type->getSlug()] = $type;
        }

        $typesArr['piso'] = array(
            // interiores
            'Aire Acondicionado',
            'Amueblado',
            'Armarios',
            'Calefacción',
            'Cocina equipada',
            'Cocina Office',
            'Domótica',
            'Electrodomésticos',
            'Gres / Cerámica',
            'Horno',
            'Internet',
            'Lavadero',
            'Lavadora',
            'Microondas',
            'Nevera',
            'No amueblado',
            'Parquet',
            'Puerta blindada',
            'Se aceptan mascotas',
            'Suite con baño',
            'Televisión',
            // exteriores
            'Balcones',
            'Con vistas al mar',
            'Jardín Privado',
            'Patio',
            'Piscina',
            'Piscina comunitaria',
            'Primera línea de mar',
            'Terraza',
            'Vistas a la montaña',
            'Zona comunitaria',
            'Zona deportiva',
            'Zona infantil',
            // finca
            'Ascensor',
            'Conserje',
            'Energía solar',
            'Garaje privado',
            'Parking comunitario',
            'Trastero',
            'Video portero',
        );
        $typesArr['casa'] = $typesArr['piso'];
        $typesArr['local'] = array(
            'Agua caliente',
            'Aire Acondicionado',
            'Calefacción',
            'Salida de humos',
        );
        $typesArr['oficina'] = array(
            'Aire Acondicionado',
            'Amueblado',
            'Ascensor',
            'Calefacción',
            'Garaje privado',
            'Terraza',
            'Trastero',
        );
        $typesArr['parking'] = array(
            'Puerta automática',
            'Sistema de seguridad/vigilancia',
        );
        $typesArr['trastero'] = array(
            'Acceso 24h todos los días del año',
            'Alarma individual en trastero',
            'Código de acceso personal para acceder al trastero',
            'Elementos de transporte interno gratuitos',
            'Parking gratuito',
            'Servicio de mudanza con furgoneta gratuita',
            'Sistema de video vigilancia cctv 24h',
            'Zona de carga / descarga',
        );

        $extrasKeyByName = array();

        foreach ($typesArr as $typeSlug => $typeArr) {
            // type
            $type = $types[$typeSlug];

            foreach ($typeArr as $name) {
                if (!key_exists($name, $extrasKeyByName)) {
                    $entity = new Extra();
                    $entity->setName($name);
                    $slug = $this->container->get('sonata.core.slugify.cocur')->slugify($name, '-');
                    $entity->setSlug($slug);

                    // agrega type
                    $entity->addType($type);

                    $manager->persist($entity);
                    $extrasKeyByName[$name] = $entity;
                } else {
                    $entity = $extrasKeyByName[$name];
                    // agrega type
                    $entity->addType($type);
                    $manager->persist($entity);
                }
            }
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
        return 150;
    }
}