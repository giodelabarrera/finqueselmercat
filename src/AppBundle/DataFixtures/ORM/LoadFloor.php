<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 26/10/16
 * Time: 21:53
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Floor;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadFloor
 * @package AppBundle\DataFixtures\ORM
 */
class LoadFloor extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
            'Sótano',
            'Subsótano',
            'Bajos',
            'Entresuelo',
            'Principal',
            '1º',
            '2º',
            '3º',
            '4º',
            '5º',
            '6º',
            '7º',
            '8º',
            '9º',
            '10º',
            '11º',
            '12º',
            '13º',
            '14º',
            '15º',
            'A partir del 15º',
            'Ático',
            'Sobreático',
            'Planta baja',
            'Medio',
            'Último',
            'Terraza',
            'Otro',
        );

        $numOrder = 1;
        foreach ($names as $name) {
            $entity = new Floor();
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
        return 80;
    }
}