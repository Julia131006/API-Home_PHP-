<?php


namespace src\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Vote extends DataTransferObject
{
    public string $id;
    public string $image_id;
}
/*
{
    "country_code": null,
    "created_at": "2018-10-24T08:36:24.000Z",
    "id": 31101,
    "image_id": "8eq",
    "sub_id": null,
    "value": 1
  },
  {
    "country_code": null,
    "created_at": "2018-10-24T08:36:28.000Z",
    "id": 31102,
    "image_id": "39i",
    "sub_id": null,
    "value": 1
  }
*/