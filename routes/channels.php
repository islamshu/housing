<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admin-notifications', function ($user) {
    return $user instanceof App\Admin; // Check if the user is an admin instance
});