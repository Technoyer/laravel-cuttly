<?php
/**
 * CuttlyServer class.. connecting api and make the api functions from here...
 * By: Technoyer Solutions Ltd
 * Author: Mohamed Gomaa <technoyer@gmail.com>
 * Company URL: www.technoyer.com
 */
namespace Technoyer\Cuttly\Facade;

use Illuminate\Support\Facades\Facade;

class Cuttly extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cuttly';
    }
}