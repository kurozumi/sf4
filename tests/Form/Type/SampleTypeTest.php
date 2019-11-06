<?php

namespace App\Tests\Form\Type;

use App\Entity\Sample;
use App\Form\SampleType;

class SampleTypeTest extends BaseTypeTestCase
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
}
