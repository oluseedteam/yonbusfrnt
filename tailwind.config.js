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
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#005DFF', // Primary Blue
                    600: '#0052e0',
                    700: '#002B8A', // Dark Blue
                    800: '#001e66',
                    900: '#001242',
                },
                accent: {
                    500: '#00A3FF', // Secondary Blue
                },
                surface: {
                    light: '#F8FAFC',
                    dark: '#0B0F19',
                    card: '#FFFFFF',
                    'card-dark': '#111827',
                }
            },
            backgroundImage: {
                'yonbus-primary': 'linear-gradient(135deg, #031B4E 0%, #063B8F 50%, #005DFF 100%)',
                'yonbus-secondary': 'linear-gradient(135deg, #063B8F 0%, #1683FF 100%)',
                'yonbus-cta': 'linear-gradient(135deg, #031B4E 0%, #005DFF 100%)',
                'yonbus-cta-hover': 'linear-gradient(135deg, #063B8F 0%, #1683FF 100%)',
                'yonbus-subtle': 'linear-gradient(180deg, #FFFFFF 0%, #F5F9FF 100%)',
                'yonbus-card-glow': 'radial-gradient(ellipse at top, rgba(0, 93, 255, 0.08) 0%, transparent 70%)',
            },
            fontFamily: {
                heading: ['Outfit', 'Poppins', ...defaultTheme.fontFamily.sans],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'soft': '0 10px 30px -5px rgba(0, 93, 255, 0.05), 0 4px 12px -2px rgba(0, 0, 0, 0.03)',
                'soft-hover': '0 20px 40px -15px rgba(0, 93, 255, 0.12), 0 8px 16px -4px rgba(0, 0, 0, 0.05)',
                'card': '0 4px 20px 0 rgba(0, 0, 0, 0.04)',
            },
            borderRadius: {
                'card': '16px',
                '2xl': '1rem',
                '3xl': '1.5rem',
            }
        },
    },

    plugins: [forms],
};
