<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 3/11/16
 * Time: 10:03
 */

namespace AppBundle\Validator\Constraints;

use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class NotRepeatedEntitiesValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if ($value instanceof PersistentCollection) {
            // si no esta vacio
            if (!$value->isEmpty()) {

                $collection = $value->unwrap(); // ArrayCollection
                $entitiesId = array();

                foreach ($collection as $key => $entity) {
                    if (!in_array($entity->getId(), $entitiesId))
                        $entitiesId[] = $entity->getId();
                    else {
                        // @TODO: hacer que se muestre el error en el campo y no en el form
                        $this->context->buildViolation($constraint->message)
                            ->setParameter('{{ value }}', $entity)
                            ->setInvalidValue($entity)
                            ->addViolation();
                    }
                }

            }
        }
    }
}