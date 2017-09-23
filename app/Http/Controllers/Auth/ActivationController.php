<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\ActivationToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\ResendActivationMailRequested;


class ActivationController extends Controller
{
    public function activate(ActivationToken $token)
	{
		if($token->expired())
		{
			$token->update(['token' => str_random(128)]);
			return redirect('login')->withError('Your token has expired. <a href="' . route('auth.activate.resend', $token->user) .'">Resend token</a>');
		}

		$token->user()->update(['active' => true]);
		$token->delete();

		return redirect('login')->withSuccess('Account has been activated.');
	}

	public function resend(User $user)
	{
		if($user->isActivated())
		{
			return redirect('/login')->withInfo('User is already activated.');
		}

		if($user->activationToken->minutesSinceLastUpdate() < $user->activationToken->getMailTimeoutInMinutes())
		{
			return redirect('login')->withInfo('Please wait ' . ($user->activationToken->getMailTimeoutInMinutes() - $user->activationToken->minutesSinceLastUpdate()) . ' more minutes before sending another email');
		}

		event(new ResendActivationMailRequested($user));

		return redirect('login')->withInfo('Activation email has been send.');
	}
}
