<?php

namespace Tests\Feature\Models;

use App\Models\Status;
use Tests\ModelTestCase;

class StatusTest extends ModelTestCase
{
    public function test_model_configuration()
    {
        $this->runConfigurationAssertions(new Status(), fillable: [
            'name'
        ]);
    }

    public function test_project_relation()
    {

    }
}
