<?php


namespace App\Tests\Form\Type;


use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

abstract class BaseTypeTestCase extends TypeTestCase
{
    protected function getExtensions()
    {
        $validator = Validation::createValidator();

        // if you also need to read constraints from annotations
//        $validator = Validation::createValidatorBuilder()
//            ->enableAnnotationMapping()
//            ->getValidator();

        return [
            new ValidatorExtension($validator)
        ];
    }
}