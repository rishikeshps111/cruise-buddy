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
                        'route' => 'dashboard', 
                        'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 7.5L10 1.67L17.5 7.5V16.67C17.5 17.11 17.32 17.53 17.01 17.85C16.7 18.16 16.28 18.33 15.83 18.33H4.17C3.72 18.33 3.3 18.16 2.99 17.85C2.68 17.53 2.5 17.11 2.5 16.67V7.5Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.5 18.33V10H12.5V18.33" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>',
                    ],
                    [
                        'name' => 'Owners',
                        'route' => 'owners.index', 
                        'icon' => '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.99 14.07C7.44 14.07 4.41 14.6 4.41 16.75C4.41 18.9 7.42 19.45 10.99 19.45C14.53 19.45 17.56 18.92 17.56 16.77C17.56 14.62 14.55 14.07 10.99 14.07Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.99 11.01C13.31 11.01 15.2 9.12 15.2 6.79C15.2 4.47 13.31 2.58 10.99 2.58C8.66 2.58 6.77 4.47 6.77 6.79C6.77 9.11 8.64 11.01 10.99 11.01Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>',
                    ],
                    [
                        'name' => 'Locations',
                        'route' => 'locations.index', 
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5 10.5005C14.5 9.11924 13.3808 8 12.0005 8C10.6192 8 9.5 9.11924 9.5 10.5005C9.5 11.8808 10.6192 13 12.0005 13C13.3808 13 14.5 11.8808 14.5 10.5005Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>',
                    ],
                    [
                        'name' => 'Amenities',
                        'route' => 'amenities.index', 
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.419 15.7321C21.419 19.3101 19.31 21.4191 15.732 21.4191H7.95C4.363 21.4191 2.25 19.3101 2.25 15.7321V7.93212C2.25 4.35912 3.564 2.25012 7.143 2.25012H9.143C9.861 2.25112 10.537 2.58812 10.967 3.16312L11.88 4.37712C12.312 4.95112 12.988 5.28912 13.706 5.29012H16.536C20.123 5.29012 21.447 7.11612 21.447 10.7671L21.419 15.7321Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.48096 14.463H16.216" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>',
                    ],
                    [
                        'name' => 'Cruise Types',
                        'route' => 'cruise-type.index', 
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>',
                    ],
                    [
                        'name' => 'Cruises',
                        'route' => 'cruises.index', 
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z" stroke="#888"  stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>',
                    ],
                    // [
                    //     'name' => 'Owners',
                    //     'route' => 'owners.index',
                    //     'icon' => '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    //                 <path d="M10.99 14.07C7.44 14.07 4.41 14.6 4.41 16.75C4.41 18.9 7.42 19.45 10.99 19.45C14.53 19.45 17.56 18.92 17.56 16.77C17.56 14.62 14.55 14.07 10.99 14.07Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                    //                 <path d="M10.99 11.01C13.31 11.01 15.2 9.12 15.2 6.79C15.2 4.47 13.31 2.58 10.99 2.58C8.66 2.58 6.77 4.47 6.77 6.79C6.77 9.11 8.64 11.01 10.99 11.01Z" stroke="#888" stroke-linecap="round" stroke-linejoin="round"/>
                    //                </svg>',
                    //     'subMenu' => [
                    //         ['name' => 'List', 'route' => 'owners.index'],
                    //         ['name' => 'Add New', 'route' => 'profile.edit'],
                    //     ],
                    // ],
                ],
            ],
        ];
    }
}
