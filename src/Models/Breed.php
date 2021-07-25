<?php

namespace src\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Breed extends DataTransferObject
{
    public string $adaptability;
    public string $cfa_url;
    public int $widescriptiondth;
    public int $image;
}
