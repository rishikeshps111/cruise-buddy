<?php

namespace App\Helpers;

class MenuHelper
{
    /**
     * Get the sidebar menu items.
     *
     * @return array
     */
    public static function getMenuItems()
    {
        return [
            [
                'title' => 'YOUR COMPANY',
                'items' => [
                    [
                        'name' => 'Dashboard',
                        'route' => 'dashboard', // Define the route name for employees
                        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 7.5L10 1.67L17.5 7.5V16.67C17.5 17.11 17.32 17.53 17.01 17.85C16.7 18.16 16.28 18.33 15.83 18.33H4.17C3.72 18.33 3.3 18.16 2.99 17.85C2.68 17.53 2.5 17.11 2.5 16.67V7.5Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.5 18.33V10H12.5V18.33" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>',
                    ],
                    [
                        'name' => 'Users',
                        'route' => 'dashboard', // Define the route name for employees
                        'icon' => '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.99 14.07C7.44 14.07 4.41 14.6 4.41 16.75C4.41 18.9 7.42 19.45 10.99 19.45C14.53 19.45 17.56 18.92 17.56 16.77C17.56 14.62 14.55 14.07 10.99 14.07Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.99 11.01C13.31 11.01 15.2 9.12 15.2 6.79C15.2 4.47 13.31 2.58 10.99 2.58C8.66 2.58 6.77 4.47 6.77 6.79C6.77 9.11 8.64 11.01 10.99 11.01Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>',
                        'subMenu' => [
                            ['name' => 'List', 'route' => 'profile.edit'],
                            ['name' => 'Add New', 'route' => 'profile.edit'],
                        ],
                    ],
                ],
            ],
        ];
    }
}