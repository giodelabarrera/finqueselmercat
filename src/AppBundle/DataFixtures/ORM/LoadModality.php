<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 9/11/16
 * Time: 0:15
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Modality;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadModality
 * @package AppBundle\DataFixtures\ORM
 */
class LoadModality extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
            'Venta',
            'Alquiler residencial (mensual)',
            'Alquiler vacacional',
            'Compartir',
        );

        $numOrder = 1;
        foreach ($names as $name) {
            $entity = new Modality();
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
        return 170;
    }
}
