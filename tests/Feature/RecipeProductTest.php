<?php

use App\Models\PostRecipes;

it('scopes the recipe product relation to enabled products', function () {
    expect((new PostRecipes)->enabledProduct()->toSql())
        ->toContain('`enable` = ?');
});
