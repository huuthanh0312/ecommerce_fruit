<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart as ModelsCart;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        if (!empty(url()->previous())) {
            session(['previous_url' => url()->previous()]);
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if ($request->user()->status === 'inactive') {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $notification = array(
                'message' => 'Your Account Has Been Locked',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $request->session()->regenerate();
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $url = '';
        if ($request->user()->role === 'admin') {

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $notification = array(
                'message' => 'Please Access The Admin Link',
                'alert-type' => 'warning'
            );

            return redirect()->route('admin.login')->with($notification);
        } elseif ($request->user()->role === 'user') {
            $carts = Cart::content();
            if (!empty($carts)) {
                foreach ($carts as $cart) {
                    $check_cart = ModelsCart::where('user_id', $request->user()->id)
                        ->where('product_id', $cart->id)->first();
                    if (!empty($check_cart)) {
                        $check_cart->qty = $check_cart->qty + $cart->qty;
                        $check_cart->save();
                    } else {
                        $cart_user = new ModelsCart();
                        $cart_user->user_id = $id;
                        $cart_user->product_id = $cart->id;
                        $cart_user->name = $cart->name;
                        $cart_user->qty = $cart->qty;
                        $cart_user->price = $cart->price;
                        $cart_user->image = $cart->options->image;
                        $cart_user->save();
                    }
                }
                Cart::destroy();
            }

            $carts_user = ModelsCart::where('user_id', $request->user()->id)->get();

            if (!empty($carts_user)) {
                foreach ($carts_user as $cart) {
                    Cart::add([
                        'id' => $cart->product_id,
                        'name' => $cart->name,
                        'qty' => $cart->qty,
                        'price' => $cart->price,
                        'options' => [
                            'image' => $cart->image,
                        ]
                    ]);
                }
            }

            $url = '/dashboard';
            if (Session::has('previous_url') && Session::get('previous_url') != '/') {
                $url = Session::get('previous_url');
            }
            $notification = array(
                'message' => '' . $profileData->name . ' Login Successfully',
                'alert-type' => 'info'
            );
            return redirect()->intended($url)->with($notification);
        }

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function AdminStore(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if ($request->user()->status === 'inactive') {
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            $notification = array(
                'message' => 'Your Account Has Been Locked',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $request->session()->regenerate();
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $url = '';
        if ($request->user()->role === 'admin') {
            $request->session()->regenerate();
            $url = 'admin/dashboard';
            $notification = array(
                'message' => '' . $profileData->name . ' Login Successfully',
                'alert-type' => 'info'
            );
            return redirect()->intended($url)->with($notification);
        } elseif ($request->user()->role === 'user') {

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            $notification = array(
                'message' => 'Access Is Denied',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
