<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Social\FacebookServiceProvider;
use App\Social\GoogleServiceProvider;
use App\Social\LinkedinServiceProvider;
use App\Social\LiveServiceProvider;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Two\InvalidStateException;
use League\OAuth1\Client\Credentials\CredentialsException;

class SocialController extends Controller
{
    protected $providers = [
        'facebook' => FacebookServiceProvider::class,
        'google' => GoogleServiceProvider::class,
        'linkedin' => LinkedinServiceProvider::class,
        'live' => LiveServiceProvider::class,
    ];

    /**
     *  Redirect the user to provider authentication page
     * 
     *  @param  string $driver
     *  @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        return (new $this->providers[$driver])->redirect();        
    }

        /**
     *  Handle provider response
     * 
     *  @param  string $driver
     *  @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {   
        try {
            return (new $this->providers[$driver])->handle();
        } catch (InvalidStateException $e) {
            return $this->redirectToProvider($driver);
        } catch (ClientException $e) {
            return $this->redirectToProvider($driver);
        } catch (CredentialsException $e) {
            return $this->redirectToProvider($driver);
        }
    }
}
