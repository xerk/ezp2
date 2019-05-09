<?php
namespace App\Http\Controllers\Api;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
	use SendsPasswordResetEmails;
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}
	public function __invoke(Request $request)
	{
		$user = User::where('email', $request->email)->first();
		$validator = Validator::make($request->all(), [
			'email' => 'required|string|email|max:255'
		]);

		if ($validator->fails()) {    
			return response()->json(['message' => 'The given data was invalid.', 'errors' => [$validator->messages()]], 200);
		}
		if ($user) {
			// We will send the password reset link to this user. Once we have attempted
			// to send the link, we will examine the response then see the message we
			// need to show to the user. Finally, we'll send out a proper response.
			$response = $this->broker()->sendResetLink(
				$request->only('email')
			);

			
			return $response == Password::RESET_LINK_SENT
				? response()->json(['message' => 'Reset link sent to your email.', 'status' => true], 201)
				: response()->json(['message' => 'Unable to send reset link', 'status' => false], 401);
		} else {
			return response()->json(['message' => __('This email does not exist')]);
		}
	}
}