<?php

namespace App\Classes\Tinkoff;

class TinkoffRequisites
{
    private int $id;

    public function __construct()
    {

    }

    public function __toArray()
    {
        return [
            'id' => $this->id

        ]
    }
}
