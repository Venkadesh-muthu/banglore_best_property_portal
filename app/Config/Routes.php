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
$routes->get('resources/(:segment)', 'MainController::resourceDetail/$1');

$routes->get('services', 'MainController::services');
$routes->get('about', 'MainController::about');
$routes->get('contact_us', 'MainController::contact_us');
$routes->post('ors_proxy', 'MainController::ors_proxy');
$routes->group('admin', function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->post('login', 'AdminController::login');
    $routes->get('logout', 'AdminController::logout');
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('profile', 'AdminController::profile');
    $routes->get('add-property', 'AdminController::add_property');
    $routes->post('save-property', 'AdminController::save_property');
    $routes->get('properties', 'AdminController::properties');
    $routes->get('property/edit/(:num)', 'AdminController::edit_property/$1');
    $routes->post('property/save-amenities-specs/(:num)', 'AdminController::saveAmenitiesAndSpecifications/$1');
    $routes->post('property/update/(:num)', 'AdminController::update_property/$1');
    $routes->delete('property/delete/(:num)', 'AdminController::delete_property/$1');
    $routes->get('property/images/(:num)', 'AdminController::view_property_images/$1');
    $routes->delete('properties/delete-video/(:num)', 'AdminController::deleteVideo/$1');
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
    // ========== ABOUT SECTION ==========
    $routes->get('about', 'AdminController::about');
    $routes->get('add-about', 'AdminController::add_about');
    $routes->post('save-about', 'AdminController::save_about');
    $routes->get('edit-about/(:num)', 'AdminController::edit_about/$1');
    $routes->post('update-about/(:num)', 'AdminController::update_about/$1');
    $routes->delete('delete-about/(:num)', 'AdminController::delete_about/$1');

    // ========== FEATURE SECTION ==========
    $routes->get('features', 'AdminController::features');
    $routes->get('add-feature', 'AdminController::add_feature');
    $routes->post('save-feature', 'AdminController::save_feature');
    $routes->get('edit-feature/(:num)', 'AdminController::edit_feature/$1');
    $routes->post('update-feature/(:num)', 'AdminController::update_feature/$1');
    $routes->delete('delete-feature/(:num)', 'AdminController::delete_feature/$1');

    // ========== TEAM SECTION ==========
    $routes->get('team', 'AdminController::team');
    $routes->get('add-team', 'AdminController::add_team');
    $routes->post('save-team', 'AdminController::save_team');
    $routes->get('edit-team/(:num)', 'AdminController::edit_team/$1');
    $routes->post('update-team/(:num)', 'AdminController::update_team/$1');
    $routes->delete('delete-team/(:num)', 'AdminController::delete_team/$1');

    // ========== STATISTICS SECTION ==========
    $routes->get('statistics', 'AdminController::statistics');
    $routes->get('add-statistic', 'AdminController::add_statistic');
    $routes->post('save-statistic', 'AdminController::save_statistic');
    $routes->get('edit-statistic/(:num)', 'AdminController::edit_statistic/$1');
    $routes->post('update-statistic/(:num)', 'AdminController::update_statistic/$1');
    $routes->delete('delete-statistic/(:num)', 'AdminController::delete_statistic/$1');

    // Resources Routes
    $routes->get('resources', 'AdminController::resources');
    $routes->get('add-resource', 'AdminController::addResource');
    $routes->post('save-resource', 'AdminController::saveResource');
    $routes->get('edit-resource/(:num)', 'AdminController::editResource/$1');
    $routes->post('update-resource/(:num)', 'AdminController::updateResource/$1');
    $routes->delete('delete-resource/(:num)', 'AdminController::deleteResource/$1');

    $routes->get('contact-us', 'AdminController::contact_us');
    $routes->get('add-contact', 'AdminController::add_contact');
    $routes->post('save-contact', 'AdminController::save_contact');
    $routes->get('edit-contact/(:num)', 'AdminController::edit_contact/$1');
    $routes->post('update-contact/(:num)', 'AdminController::update_contact/$1');
    $routes->delete('delete-contact/(:num)', 'AdminController::delete_contact/$1');


});
