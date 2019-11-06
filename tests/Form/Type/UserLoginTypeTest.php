<?php

namespace App\Tests\Form\Type;

use App\Form\UserLoginType;

class UserLoginTypeTest extends BaseTypeTestCase
{
    public function test正しいデータを送信()
    {
        $formData = [
            "username" => "username",
            "password" => "pass"
        ];

        $form = $this->factory->create(UserLoginType::class);

        $form->submit($formData);

        $this->assertTrue($form->isValid());
    }

    public function testパスワードチェック()
    {
        $formData = [
            "username" => "username",
            "password" => "password"
        ];

        $form = $this->factory->create(UserLoginType::class);

        $form->submit($formData);

        $this->assertFalse($form->isValid());
    }
}
