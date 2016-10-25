<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 15/10/16
 * Time: 18:31
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subtype;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadSubtype
 * @package AppBundle\DataFixtures\ORM
 */
class LoadSubtype extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        // subtypes
        $subtypesName['piso'] = array(
            'Semisótano',
            'Triplex',
            'Dúplex',
            'Buhardilla',
            'Ático',
            'Estudio',
            'Loft',
            'Otro',
            'Piso',
            'Apartamento',
            'Planta baja',
        );
        $subtypesName['casa'] = array(
            'Casa',
            'Cortijo',
            'Adosada',
            'Caserio',
            'Pareada',
            'Chalet/Torre',
            'Masía',
            'Unifamiliar',
            'Casa rústica',
            'Casa de pueblo',
            'Casa rural',
            'Bungalow',
            'Casona',
        );
        $subtypesName['local'] = array(
            'En mercado público',
            '1ª línea comercial',
            'Gran almacén',
            '3ª línea comercial',
            'Enclave estratégico',
            '2ª línea comercial',
            '1ª línea de lujo',
            'Almacén',
            'Sótano',
            'En gran superficie especializada',
            'Factory outlet',
            'En espacios comerciales',
            'Comercio de barrio',
            'En centro comercial',
            'Oficina',
            'Polígono Industrial',
        );
        $subtypesName['oficina'] = array(
            'Otro',
            'Media representatividad',
            'Alta representatividad',
            'Baja representatividad',
            'Centro de negocios',
            'Piso',
        );
        /*$subtypesName['edificio'] = array(
            'Residencial',
            'Industrial',
            'Mixto',
            'Oficinas',
        );
        $subtypesName['suelo'] = array(
            'Ganadero',
            'Otro',
            'Urbanizable',
            'Equipamientos',
            'Residencial',
            'Comercial',
            'Parcelable',
            'Agrícola',
            'Industrial',
            'Terciario',
        );
        $subtypesName['industrial'] = array(
            'Nave comercial',
            'Polígono urbanizado',
            'Polígono semiurbanizado',
            'Nave industrial',
            'Polígono no urbanizado',
        );*/
        $subtypesName['parking'] = array(
            'Negocio',
            'Otro',
            'Moto',
            'Doble',
            'Individual',
        );
        /*
        $subtypesName['hotel'] = array(
            'Residencia 3ª Edad',
            'Apart Hotel',
            'Hotel',
            'Turismo Rural',
        );*/
        $subtypesName['trastero'] = array(
        );

        foreach ($types as $typeSlug => $type) {

            $subtypeNameArr = $subtypesName[$typeSlug];
            $numOrder = 1;

            foreach ($subtypeNameArr as $name) {

                $subtype = new Subtype();
                $subtype->setName($name);
                $subtype->setNumOrder($numOrder);
                $subtype->setType($type);

                $manager->persist($subtype);
                $numOrder++;
            }
        }

        /*$subtypesRepeated = array();

        foreach ($types as $typeSlug => $type) {

            $subtypeNameArr = $subtypesName[$typeSlug];
            $numOrder = 1;

            foreach ($subtypeNameArr as $name) {

                $subtype = null;
                if (!key_exists($name, $subtypesRepeated)) {
                    $subtype = new Subtype();
                    $subtype->setName($name);

                    $slug = $this->container->get('sonata.core.slugify.cocur')->slugify($name, '-');
                    $subtype->setSlug($slug);
                    $subtype->setNumOrder($numOrder);

                    $subtypesRepeated[$name] = $subtype;
                    $numOrder++;
                }
                else {
                    $subtype = $subtypesRepeated[$name];
                }
                $manager->persist($subtype);

                $type->addSubtype($subtype);
                $manager->persist($type);
            }
        }*/
        $manager->flush();
    }


    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 20;
    }
}