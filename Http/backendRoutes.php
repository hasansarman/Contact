<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/contact'], function (Router $router) {
    $router->bind('contact', function ($id) {
        return app('Modules\Contact\Repositories\ContactRepository')->find($id);
    });
    $router->get('contacts', [
        'as' => 'admin.contact.contact.index',
        'uses' => 'ContactController@index',
        'middleware' => 'can:contact.contacts.index'
    ]);
    $router->get('contacts/{contacts}/details', [
        'as' => 'admin.contact.contact.details',
        'uses' => 'ContactController@details',
        'middleware' => 'can:contact.contacts.index'
    ]);
    $router->post('contacts/{contacts}/details/send_me', [
        'as' => 'admin.contact.contacts.send_me',
        'uses' => 'ContactController@send_me',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->post('contacts/{contacts}/details/end_me', [
        'as' => 'admin.contact.contacts.end_me',
        'uses' => 'ContactController@end_me',
        'middleware' => 'can:contact.contacts.create'
    ]);



    $router->get('contact_categories', [
        'as' => 'admin.contact.contact_categories',
        'uses' => 'ContactController@contact_categories',
        'middleware' => 'can:contact.contacts.contact_categories'
    ]);


    $router->get('contact_categories/create', [
        'as' => 'admin.contact.contact_categories.create',
        'uses' => 'ContactController@contact_categories_create',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->post('contact_categories', [
        'as' => 'admin.contact.contact_categories.store',
        'uses' => 'ContactController@contact_categories_store',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->get('contact_categories/{contact_categories}/edit', [
        'as' => 'admin.contact.contact_categories.edit',
        'uses' => 'ContactController@contact_categories_edit',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->put('contact_categories/{contact_categories}', [
        'as' => 'admin.contact.contact_categories.update',
        'uses' => 'ContactController@contact_categories_update',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->delete('contact_categories/{contact_categories}', [
        'as' => 'admin.contact.contact_categories.destroy',
        'uses' => 'ContactController@contact_categories_destroy',
        'middleware' => 'can:contact.contacts.destroy'
    ]);


});
