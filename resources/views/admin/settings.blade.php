@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Settings
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Manage your application settings and preferences
            </p>
        </div>
    </div>

    <!-- Success Alert -->
    <x-admin.alert type="success" class="mb-6">
        Settings saved successfully!
    </x-admin.alert>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- General Settings -->
        <div class="lg:col-span-2">
            <x-admin.card>
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-gray-900">General Settings</h3>
                </x-slot>

                <form class="space-y-6">
                    <div>
                        <x-admin.input 
                            label="Application Name" 
                            value="My Laravel App"
                            placeholder="Enter application name"
                        />
                    </div>

                    <div>
                        <x-admin.input 
                            label="Application URL" 
                            value="https://myapp.com"
                            placeholder="Enter application URL"
                        />
                    </div>

                    <div>
                        <x-admin.textarea 
                            label="Application Description" 
                            placeholder="Enter application description"
                            :rows="3"
                        >
                            A modern Laravel application with admin panel
                        </x-admin.textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <x-admin.input 
                            label="Contact Email" 
                            type="email"
                            value="admin@myapp.com"
                            placeholder="Enter contact email"
                        />
                        
                        <x-admin.input 
                            label="Support Phone" 
                            value="+1 (555) 123-4567"
                            placeholder="Enter support phone"
                        />
                    </div>

                    <div class="flex items-center">
                        <input id="maintenance-mode" name="maintenance-mode" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="maintenance-mode" class="ml-2 block text-sm text-gray-900">
                            Enable maintenance mode
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input id="user-registration" name="user-registration" type="checkbox" checked class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="user-registration" class="ml-2 block text-sm text-gray-900">
                            Allow user registration
                        </label>
                    </div>
                </form>

                <x-slot name="footer">
                    <div class="flex justify-end">
                        <x-admin.button variant="primary">
                            Save General Settings
                        </x-admin.button>
                    </div>
                </x-slot>
            </x-admin.card>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Email Settings -->
            <x-admin.card>
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-gray-900">Email Settings</h3>
                </x-slot>

                <form class="space-y-4">
                    <x-admin.input 
                        label="SMTP Host" 
                        value="smtp.gmail.com"
                        placeholder="Enter SMTP host"
                    />

                    <x-admin.input 
                        label="SMTP Port" 
                        value="587"
                        placeholder="Enter SMTP port"
                    />

                    <x-admin.input 
                        label="SMTP Username" 
                        value="your-email@gmail.com"
                        placeholder="Enter SMTP username"
                    />

                    <x-admin.input 
                        label="SMTP Password" 
                        type="password"
                        placeholder="Enter SMTP password"
                    />

                    <div class="flex items-center">
                        <input id="smtp-encryption" name="smtp-encryption" type="checkbox" checked class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="smtp-encryption" class="ml-2 block text-sm text-gray-900">
                            Use TLS encryption
                        </label>
                    </div>
                </form>

                <x-slot name="footer">
                    <div class="flex justify-end">
                        <x-admin.button variant="primary" size="sm">
                            Save Email Settings
                        </x-admin.button>
                    </div>
                </x-slot>
            </x-admin.card>

            <!-- Security Settings -->
            <x-admin.card>
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-gray-900">Security</h3>
                </x-slot>

                <form class="space-y-4">
                    <x-admin.input 
                        label="Session Timeout (minutes)" 
                        value="120"
                        placeholder="Enter session timeout"
                    />

                    <x-admin.input 
                        label="Max Login Attempts" 
                        value="5"
                        placeholder="Enter max login attempts"
                    />

                    <div class="flex items-center">
                        <input id="two-factor-auth" name="two-factor-auth" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="two-factor-auth" class="ml-2 block text-sm text-gray-900">
                            Enable two-factor authentication
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input id="password-reset" name="password-reset" type="checkbox" checked class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <label for="password-reset" class="ml-2 block text-sm text-gray-900">
                            Allow password reset
                        </label>
                    </div>
                </form>

                <x-slot name="footer">
                    <div class="flex justify-end">
                        <x-admin.button variant="primary" size="sm">
                            Save Security Settings
                        </x-admin.button>
                    </div>
                </x-slot>
            </x-admin.card>

            <!-- Danger Zone -->
            <x-admin.card>
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-red-600">Danger Zone</h3>
                </x-slot>

                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Clear Cache</h4>
                        <p class="text-sm text-gray-500">Clear all application cache</p>
                        <x-admin.button variant="danger" size="sm" class="mt-2">
                            Clear Cache
                        </x-admin.button>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="text-sm font-medium text-gray-900">Reset Database</h4>
                        <p class="text-sm text-gray-500">Reset all database data (irreversible)</p>
                        <x-admin.button variant="danger" size="sm" class="mt-2">
                            Reset Database
                        </x-admin.button>
                    </div>
                </div>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection