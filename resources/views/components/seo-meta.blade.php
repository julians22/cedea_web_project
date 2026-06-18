@php
    $currentRoute = request()->route();
    $routeName = $currentRoute?->baseName();

    if ($routeName) {
        $routeParameters = collect($currentRoute->parameters())
            ->except('locale')
            ->all();

        $queryParameters = [
            'product' => 'product',
            'videos' => 'video',
        ];

        if (isset($queryParameters[$routeName]) && request()->filled($queryParameters[$routeName])) {
            $routeParameters[$queryParameters[$routeName]] = request()->string($queryParameters[$routeName])->toString();
        }

        $defaultLocale = \NielsNumbers\LaravelLocalizer\Facades\Localizer::defaultLocale();
        $hideDefaultLocale = \NielsNumbers\LaravelLocalizer\Facades\Localizer::hideDefaultLocale();
        $localizedUrls = collect(\NielsNumbers\LaravelLocalizer\Facades\Localizer::supportedLocales())
            ->mapWithKeys(fn (string $locale) => [
                $locale => $locale === $defaultLocale && $hideDefaultLocale
                    ? route("without_locale.{$routeName}", $routeParameters)
                    : route($routeName, [...$routeParameters, 'locale' => $locale]),
            ]);

        $canonicalUrl = $localizedUrls->get(app()->getLocale(), url()->current());

        \Butschster\Head\Facades\Meta::setCanonical($canonicalUrl);

        if ($routeName === 'search') {
            \Butschster\Head\Facades\Meta::setRobots('noindex, follow');
        }

        foreach ($localizedUrls as $locale => $url) {
            \Butschster\Head\Facades\Meta::setHrefLang($locale, $url);
        }

        if ($defaultUrl = $localizedUrls->get($defaultLocale)) {
            \Butschster\Head\Facades\Meta::setHrefLang('x-default', $defaultUrl);
        }
    }
@endphp
