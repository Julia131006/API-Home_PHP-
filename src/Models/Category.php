<?php

namespace src\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Category extends DataTransferObject
{
    public string $id;
    public string $name;
}