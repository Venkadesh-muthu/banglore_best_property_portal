<?php

use App\Controllers\AdminController;
use App\Controllers\MainController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('properties', 'MainController::properties');
$routes->get('property_details/(:num)', 'MainController::propertyDetails/$1');
$routes->get('property/search', 'MainController::search');
$routes->get('compare_properties', 'MainController::compareProperties');
$routes->get('services/(:segment)', 'MainController::serviceDetail/$1');


$routes->get('services', 'MainController::services');
$routes->get('about', 'MainController::about');
$routes->get('contact_us', 'MainController::contact_us');
$routes->post('ors_proxy', 'MainController::ors_proxy');
$routes->group('admin', function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->post('login', 'AdminController::login');
    $routes->get('logout', 'AdminController::logout');
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('add-property', 'AdminController::add_property');
    $routes->post('save-property', 'AdminController::save_property');
    $routes->get('properties', 'AdminController::properties');
    $routes->get('property/edit/(:num)', 'AdminController::edit_property/$1');
    $routes->post('property/save-amenities-specs/(:num)', 'AdminController::saveAmenitiesAndSpecifications/$1');
    $routes->post('property/update/(:num)', 'AdminController::update_property/$1');
    $routes->delete('property/delete/(:num)', 'AdminController::delete_property/$1');
    $routes->get('property/images/(:num)', 'AdminController::view_property_images/$1');
    $routes->post('property/image/delete/(:num)', 'AdminController::delete_property_image/$1');
    $routes->delete('delete_master_plan/(:num)', 'AdminController::delete_master_plan/$1');
    $routes->delete('delete_floor_plan/(:num)', 'AdminController::delete_floor_plan/$1');
    $routes->get('developers', 'AdminController::developers');
    $routes->get('add-developer', 'AdminController::add_developer');
    $routes->post('save-developer', 'AdminController::save_developer');
    $routes->get('developer/edit/(:num)', 'AdminController::edit_developer/$1');
    $routes->post('update-developer/(:num)', 'AdminController::update_developer/$1');
    $routes->delete('developer/delete/(:num)', 'AdminController::delete_developer/$1');
    $routes->get('services', 'AdminController::services');
    $routes->get('add-service', 'AdminController::addService');
    $routes->post('save-service', 'AdminController::saveService');
    $routes->get('edit-service/(:num)', 'AdminController::editService/$1');
    $routes->post('update-service/(:num)', 'AdminController::updateService/$1');
    $routes->delete('delete-service/(:num)', 'AdminController::deleteService/$1');
});
