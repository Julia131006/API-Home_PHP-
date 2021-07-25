<?php

namespace src\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Image extends DataTransferObject
{
    public string $id;
    public string $url;
    public int $width;
    public int $height;
}