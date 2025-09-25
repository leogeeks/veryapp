@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            Create New User
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Add a new user to your system
        </p>
    </div>

    <!-- Success Alert -->
    <x-admin.alert type="success" class="mb-6">
        User created successfully!
    </x-admin.alert>

    <!-- Error Alert -->
    <x-admin.alert type="error" class="mb-6">
        There was an error creating the user. Please check the form below.
    </x-admin.alert>

    <!-- Form -->
    <x-admin.card>
        <x-slot name="header">
            <h3 class="text-lg font-medium text-gray-900">User Information</h3>
        </x-slot>

        <form class="space-y-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <x-admin.input 
                    label="First Name" 
                    placeholder="Enter first name"
                    required
                />
                
                <x-admin.input 
                    label="Last Name" 
                    placeholder="Enter last name"
                    required
                />
            </div>

            <x-admin.input 
                label="Email Address" 
                type="email"
                placeholder="Enter email address"
                required
            />

            <x-admin.input 
                label="Password" 
                type="password"
                placeholder="Enter password"
                required
            />

            <x-admin.input 
                label="Confirm Password" 
                type="password"
                placeholder="Confirm password"
                required
            />

            <x-admin.select 
                label="Role" 
                :options="['user' => 'User', 'moderator' => 'Moderator', 'admin' => 'Admin']"
                required
            />

            <x-admin.select 
                label="Status" 
                :options="['active' => 'Active', 'inactive' => 'Inactive', 'pending' => 'Pending']"
                required
            />

            <x-admin.textarea 
                label="Bio" 
                placeholder="Enter user bio (optional)"
                :rows="3"
            />

            <div class="flex items-center">
                <input id="send-welcome-email" name="send-welcome-email" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                <label for="send-welcome-email" class="ml-2 block text-sm text-gray-900">
                    Send welcome email to user
                </label>
            </div>
        </form>

        <x-slot name="footer">
            <div class="flex justify-end space-x-3">
                <x-admin.button variant="outline">
                    Cancel
                </x-admin.button>
                <x-admin.button variant="primary">
                    Create User
                </x-admin.button>
            </div>
        </x-slot>
    </x-admin.card>
</div>
@endsection