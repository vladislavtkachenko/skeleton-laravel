<?php

Route::get('', ['as' => 'admin.dashboard', function () {
    $content = '';
    return AdminSection::view($content, '');
}]);