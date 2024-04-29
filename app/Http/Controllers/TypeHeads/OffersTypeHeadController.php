<?php

namespace App\Http\Controllers\TypeHeads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \BadasoUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Offers;
use Uasoft\Badaso\Helpers\ApiResponse;

use Illuminate\Support\Facades\Validator;
use Exception;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class OffersTypeHeadController extends Controller
{
    function getUser() {
        return Offers::where('id', request()->id)->with('badasoUsers')->first()?->badasoUsers[0];
    }
    function getUserFollowup() {
        return Offers::where('id', request()->id)->with('badasoUserFollowup')->first()?->badasoUsers[0];
    }
}
