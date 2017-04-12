<?php

namespace msRolePropagination;

class App
{
    public function __construct()
    {
        new Profile();
        new Admin();
    }
}
