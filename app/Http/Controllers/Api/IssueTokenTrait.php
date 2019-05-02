<?php 
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
trait IssueTokenTrait{
	public function issueToken(Request $request, $grantType, $scope = ""){
		$params = [
    		'grant_type' => $grantType,
    		'client_id' => config('services.passport.client_id'),
    		'client_secret' => config('services.passport.client_secret'),    		
    		'scope' => $scope
    	];
        if($grantType !== 'social'){
            $params['username'] = $request->username ?: $request->email;
        }
    	$request->request->add($params);
    	$proxy = Request::create('oauth/token', 'POST');
    	return Route::dispatch($proxy);
	}
}