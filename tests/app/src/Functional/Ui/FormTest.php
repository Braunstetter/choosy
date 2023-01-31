<?php

namespace App\Functional\Ui;

use Braunstetter\Choosy\Tests\Functional\AbstractFunctionalTestCase;

class FormTest extends AbstractFunctionalTestCase
{
    public function test_image_preview()
    {
        $client = $this->initPantherClient();
        $client->request('GET', '/test');

        $client->takeScreenshot(__dir__ . '/screenshots/empty_form.png');

        $this->assertSelectorExists('.choosy-widget');
    }
}
