<?php

namespace App\Enums;

enum CrudStatus: string
{
    case CREATED = 'Successfully Created!';
    case DELETED = 'Successfully Deleted!';
    case UPDATED = 'Successfully Updated!';
    case NO_CHANGE = 'No Change';
}
