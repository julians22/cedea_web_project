<?php

namespace App\Livewire\Frontend;

use App\Models\Products\Category;
use App\Models\Products\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Spatie\Tags\Tag;

class ProductComponent extends Component
{
    public $categories;
    public $tags;

    #[Url(as: 'category', history: true)]
    public ?string $activeCategory = null;

    public $activeTags = null;

    public $products;

    public function mount($categories, $tags) {
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function render()
    {
        $this->getProducts();
        return view('livewire.frontend.product-component');
    }

    public function toggleActiveCategory($slug) {
        $this->activeCategory = $slug;
        $this->activeTags = null;
    }

    public function toggleActiveTag($slug) {
        $this->activeTags = $slug;
    }

    public function getProducts() {
        $query = Product::query();
        if (!empty($this->activeCategory)) {
            $category = Category::where('slug', $this->activeCategory)->first();
            if ($category) {
                $query = $query->where('category_id', $category->id);
            }
        }

        if (!empty($this->activeTags)) {
            $tag = Tag::where('slug->id', $this->activeTags)->first();
            $query = $query->withAnyTags([$tag]);
        }

        $this->products = $query->get();
    }
}
