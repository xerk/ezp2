<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        session()->put('previousUrl', url()->previous());
        return view('auth.login');
    }

    // override logout so cart contents remain:
    // https://github.com/Crinsane/LaravelShoppingcart/issues/253
    public function logout(Request $request)
    {
        $cart = collect(session()->get('cart'));
        $destination = \Auth::logout();
        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) {
                session()->put('cart.' . $identifier, $rows);
            });
        }
        return redirect()->to($destination);
    }
    public function redirectTo()
    {
        return str_replace(url('/'), '', session()->get('previousUrl', '/'));
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        dd($providerUser);
        $user = User::where('provider_id', $providerUser->getId())->first();
        $userTrashed = User::onlyTrashed()->where('provider_id', $providerUser->getId())->first();
        if (!$userTrashed) {
            if (!$user) {
                // Create the user
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'provider_id' => $providerUser->getId(),
                    'provider' => 'facebook',
                ]);
            }
        } else {
            session()->flash('errors', collect([__('You have been blocked, so contact with the support to know why')]));
            return redirect()->back()->with(['success' => false]);
        }
        // Login the user
        Auth::login($user, true);
        // $user->token;

        return redirect($this->redirectTo);
    }
}
