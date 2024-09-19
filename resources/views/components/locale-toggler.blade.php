<form class="flex flex-row items-center space-x-2" method="POST" action="{{ route('locale.switch') }}">
    @csrf

    @php
        $current_locale = app()->getLocale();
        $locale_list = ['ID', 'EN', 'KO'];
    @endphp

    <select class="bg-transparent" name="locale" onchange="this.form.submit()">
        @foreach ($locale_list as $locale)
            <option value="{{ $locale }}" @selected($current_locale === $locale)>
                {{ $locale }}
            </option>
        @endforeach
    </select>

</form>
