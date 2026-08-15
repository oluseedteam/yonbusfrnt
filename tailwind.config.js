import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    50:  '#EFF6FF',  // Very light blue (badge bg)
                    100: '#DBEAFE',  // Soft blue (borders)
                    200: '#BFDBFE',  // Medium-light blue
                    300: '#93C5FD',  // Sky blue
                    400: '#3B82F6',  // Bright blue accent
                    500: '#2563EB',  // Primary Blue (buttons, active)
                    600: '#1D4ED8',  // Hover blue
                    700: '#1E40AF',  // Deep blue accent (minimal use: only key headers)
                    800: '#1E3A8A',  // Deep blue (hero section, sidebar top strip only)
                    900: '#1E3070',  // Darkest — used very sparingly
                },
                accent: {
                    500: '#2563EB',
                },
                surface: {
                    light:      '#FFFFFF',    // Pure white page background
                    dark:       '#1E3A8A',    // Deep blue (sparingly — nav header strip)
                    card:       '#FFFFFF',    // Pure white cards
                    'card-dark':'#1E40AF',    // Dark mode cards
                }
            },
            fontFamily: {
                heading: ['Poppins', ...defaultTheme.fontFamily.sans],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'soft':       '0 10px 30px -5px rgba(37, 99, 235, 0.08), 0 4px 12px -2px rgba(0, 0, 0, 0.04)',
                'soft-hover': '0 20px 40px -15px rgba(37, 99, 235, 0.14), 0 8px 16px -4px rgba(0, 0, 0, 0.05)',
                'card':       '0 4px 20px 0 rgba(37, 99, 235, 0.07)',
            },
            borderRadius: {
                '2xl': '1rem',
                '3xl': '1.5rem',
            }
        },
    },

    plugins: [forms],
};
