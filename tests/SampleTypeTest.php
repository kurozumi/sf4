<?php

namespace App\Tests;

use App\Entity\Sample;
use App\Form\SampleType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Validation;

class SampleTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $datetime = new \DateTime();

        $formData = [
            "name" => "test",
            "datetime" => $datetime
        ];

        $sampleToCompare = new Sample();

        $form = $this->factory->create(SampleType::class, $sampleToCompare);

        $sample = new Sample();
        $sample->setName("test");
        $sample->setDatetime($datetime);

        $form->submit($formData);

        $this->assertTrue($form->isValid());

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($sample, $sampleToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach(array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function testSubmitNameInvalidData()
    {
        $formData = [
            "name" => "",
        ];

        $form = $this->factory->create(SampleType::class);

        $form->submit($formData);

        $this->assertFalse($form->isValid());
    }

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
