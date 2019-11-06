<?php

namespace App\Tests\Form\Type;

use App\Form\UserLoginType;

class UserLoginTypeTest extends BaseTypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            "username" => "username",
            "password" => "password"
        ];

        $form = $this->factory->create(UserLoginType::class);

        $form->submit($formData);

        $this->assertTrue($form->isValid());
    }
}
