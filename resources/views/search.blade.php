<x-layouts.app>
    {{ app()->getLocale() }}
    <div>
        <ul>
            @foreach ($news as $item)
                <li>{{ $item->title }}</li>
            @endforeach
        </ul>
    </div>
</x-layouts.app>
