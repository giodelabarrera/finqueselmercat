<?php
namespace AppBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EntityToIdTransformer implements DataTransformerInterface
{
    /**
     * Entity class
     *
     * @var string
     */
    private $class;

    /**
     * Manager
     *
     * @var ObjectManager
     */
    private $manager;


    public function __construct(ObjectManager $manager, $class)
    {
        $this->manager = $manager;
        $this->class = $class;
    }

    /**
     * Transforms an object (entity) to a string (number).
     *
     * @param  entity|null $entity
     * @return string
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return '';
        }

        return $entity->getId();
    }

    /**
     * Transforms a string (number) to an object (entity).
     *
     * @param  string $issueNumber
     * @return Issue|null
     * @throws TransformationFailedException if object (entity) is not found.
     */
    public function reverseTransform($entityNumber)
    {
        // no entity number? It's optional, so that's ok
        if (!$entityNumber) {
            return;
        }

        $entity = $this->manager
            ->getRepository($this->class)
            // query for the entity with this id
            ->find($entityNumber)
        ;

        if (null === $entity) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'The entity with number "%s" does not exist!',
                $entityNumber
            ));
        }

        return $entity;
    }
}