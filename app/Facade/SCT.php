<?php
namespace App\Facade; //created 'facade' folder in app directory
use Illuminate\Support\Facades\Facade;

class SCT extends Facade{
    protected static function getFacadeAccessor() {
        return 'SCT'; //'TestFacades' alias name for the façade class declare in the class 'NewFacadeServiceProvider'
    }
}
?>
