<?php

use App\Enums\VideoType;
use App\Livewire\ShowRecipeVideos;
use App\Models\Video;
use Livewire\Livewire;

use function Pest\Laravel\get;

it('opens a video from the url query and keeps localized canonical links', function () {
    $video = Video::query()
        ->where('type', VideoType::RECIPE)
        ->firstOrFail();

    get(route('videos', ['video' => $video->slug]), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertViewIs('videos')
        ->assertSee('data-active-video', false)
        ->assertSee('data-video-id="'.$video->slug.'"', false)
        ->assertSee('rel="canonical" href="'.route('videos', ['video' => $video->slug]).'"', false)
        ->assertSee(
            'hreflang="en" href="'.route('videos', [
                'locale' => 'en',
                'video' => $video->slug,
            ]).'"',
            false,
        );
});

it('tracks video selection and real modal views for analytics', function () {
    get(route('videos'), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee('data-video-item', false)
        ->assertSee('select_content', false)
        ->assertSee('view_video', false)
        ->assertSee('video_type', false);
});

it('binds the selected video slug to the url state', function () {
    $video = Video::query()
        ->where('type', VideoType::RECIPE)
        ->firstOrFail();

    Livewire::withQueryParams(['video' => $video->slug])
        ->test(ShowRecipeVideos::class)
        ->assertSet('videoSlug', $video->slug)
        ->assertSet('activeVideo.id', $video->id)
        ->assertSet('modalOpen', true)
        ->call('handleChangeActiveVideo')
        ->assertSet('videoSlug', null)
        ->assertSet('activeVideo', null)
        ->assertSet('modalOpen', false);
});

it('does not open a video in a component for another video type', function () {
    $video = Video::query()
        ->where('type', VideoType::TV)
        ->firstOrFail();

    Livewire::withQueryParams(['video' => $video->slug])
        ->test(ShowRecipeVideos::class)
        ->assertSet('activeVideo', null)
        ->assertSet('modalOpen', false);
});
