<?php

namespace api;

Class PatrimonioController {

    private function __construct()
    {
        $this->grupoDaoImpl = new GrupoDaoImpl();
    }
}

?>