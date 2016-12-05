<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 3/11/16
 * Time: 9:58
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotRepeatedEntities extends Constraint
{
    public $message = 'La entidad con nombre "{{ value }}" no puede estar incluida mas de una vez en la colección';
}