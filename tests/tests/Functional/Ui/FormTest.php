<?php

namespace Braunstetter\Choosy\Tests\Functional\Ui;

use Braunstetter\Choosy\Tests\Functional\AbstractFunctionalTestCase;

class FormTest extends AbstractFunctionalTestCase
{
    public function test_form_type()
    {
        $client = $this->initPantherClient();
        $client->request('GET', '/test');

        $client->takeScreenshot(__dir__ . '/screenshots/empty_form_type.png');

        $this->assertSelectorExists('.choosy-widget');
    }
}
