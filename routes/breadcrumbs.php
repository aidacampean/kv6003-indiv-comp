<?php

use App\Models\Trip;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('create-trip', function (BreadcrumbTrail $trail): void {
    $trail->parent('home');
    $trail->push('Create Trip', route('create-trip'));
});

Breadcrumbs::for('itinerary', function (BreadcrumbTrail $trail, $tripId): void {
    $trail->parent('home');
    $trail->push('Itinerary', route('itinerary', $tripId));
});

Breadcrumbs::for('collaborate', function (BreadcrumbTrail $trail, $tripId): void {
    $trail->parent('home');
    $trail->push('Manage Collaboration', route('collaborate', $tripId));
});

Breadcrumbs::for('invite', function (BreadcrumbTrail $trail, $tripId) {
    $trail->parent('collaborate', $tripId);
    $trail->push('Invite User', route('invite', $tripId));
});

Breadcrumbs::for('my-account', function (BreadcrumbTrail $trail): void {
    $trail->parent('home');
    $trail->push('My Account', route('my-account'));
});