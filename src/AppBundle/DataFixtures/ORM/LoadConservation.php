<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 26/10/16
 * Time: 21:53
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Conservation;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadConservation
 * @package AppBundle\DataFixtures\ORM
 */
class LoadConservation extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
            'Buena',
            'Muy buena',
            'Excelente',
            'Regular',
            'Necesita reforma',
        );

        $numOrder = 1;
        foreach ($names as $name) {
            $entity = new Conservation();
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
        return 130;
    }
}