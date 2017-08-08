<?php

namespace controller;

Class PatrimonioController {

    private function __construct()
    {
        $this->grupoDaoImpl = new GrupoDaoImpl();
    }
}

?>