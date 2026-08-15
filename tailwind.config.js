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
                    navy: '#031B4E',      // Deep Navy
                    dark: '#063B8F',      // Dark Blue
                    blue: '#005DFF',      // Primary Blue
                    bright: '#1683FF',    // Bright Blue
                    light: '#93C5FD',     // Light Blue for charts
                    lighter: '#DBEAFE',   // Very Light Blue for charts
                },
                surface: {
                    white: '#FFFFFF',
                    primary: '#F8FAFC',
                    card: '#F8FBFF',
                    light: '#F5F9FF',
                    subtle: '#EFF6FF',
                    soft: '#E8F1FF',
                },
                text: {
                    heading: '#031B4E',
                    body: '#475569',
                    secondary: '#64748B',
                    muted: '#94A3B8',
                    link: '#005DFF',
                },
                border: {
                    subtle: '#E2E8F0',
                    blue: '#005DFF',
                    dark: '#063B8F',
                },
                system: {
                    success: '#16A34A',
                    warning: '#F59E0B',
                    error: '#DC2626',
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
                'soft': '0 4px 20px -2px rgba(3, 27, 78, 0.05), 0 2px 6px -1px rgba(3, 27, 78, 0.02)',
                'soft-hover': '0 12px 32px -4px rgba(0, 93, 255, 0.12), 0 4px 12px -2px rgba(3, 27, 78, 0.04)',
                'card': '0 2px 12px 0 rgba(3, 27, 78, 0.04)',
                'blue-glow': '0 0 25px rgba(0, 93, 255, 0.18)',
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
