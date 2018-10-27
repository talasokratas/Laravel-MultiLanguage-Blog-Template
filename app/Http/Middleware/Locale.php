<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Illuminate\Support\Facades\App;
use Session;


class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isLocaleSelected = Session::get('manual');
        if(!empty($isLocaleSelected)){
            $locale = $this->manualLocale();
        } else {
            $locale = $this->userLocale($request);
        }

        App::setLocale($locale);
        return $next($request);
    }

    public function userLocale($request)
    {
        $userLocales = $request->getLanguages();
        if (!empty($userLocales)) {
            foreach ($userLocales as $userLocale) {
                if (in_array($userLocale, Config::get('app.locales'))) {
                    $locale = $userLocale;
                    break;
                }
            }
        } else $locale = Config::get('app.locale');
        return $locale;
    }

    public function manualLocale(){
        $raw_locale = Session::get('locale');

        if (in_array($raw_locale, Config::get('app.locales'))) {
            $locale = $raw_locale;
        } else $locale = Config::get('app.locale');

        return $locale;
    }

}
