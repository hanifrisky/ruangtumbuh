import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Inter', ...defaultTheme.fontFamily.sans],
                display: ['Plus Jakarta Sans', 'Fraunces', ...defaultTheme.fontFamily.sans],
                serif: ['Fraunces', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // 30% Green (Rich Forest + Fresh Eco Leaf)
                forest: {
                    50: '#F0FDF4',
                    100: '#DCFCE7',
                    200: '#BBF7D0',
                    300: '#86EFAC',
                    400: '#4ADE80',
                    500: '#22C55E',
                    600: '#16A34A',
                    700: '#15803D',
                    800: '#065F46',
                    900: '#064E3B',
                    950: '#022C22',
                },
                sage: {
                    50: '#F0FDF4',
                    100: '#DCFCE7',
                    200: '#BBF7D0',
                    300: '#86EFAC',
                    400: '#4ADE80',
                    500: '#22C55E',
                    600: '#16A34A',
                    700: '#15803D',
                    800: '#065F46',
                },
                // 10% Blue (Crisp Sky & Electric Cyan Accent)
                sky: {
                    50: '#F0F9FF',
                    100: '#E0F2FE',
                    200: '#BAE6FD',
                    300: '#7DD3FC',
                    400: '#38BDF8',
                    500: '#0EA5E9',
                    600: '#0284C7',
                    700: '#0369A1',
                    800: '#075985',
                    900: '#0C4A6E',
                },
                // Highlight yellow/lime badge from reference poster
                lime: {
                    100: '#ECFCCB',
                    200: '#D9F99D',
                    300: '#BEF264',
                    400: '#A3E635',
                    500: '#84CC16',
                },
                terra: {
                    50: '#F0F9FF',
                    100: '#E0F2FE',
                    200: '#BAE6FD',
                    500: '#0EA5E9',
                    600: '#0284C7',
                    700: '#0369A1',
                },
                // 60% White & Crisp Surfaces
                sand: {
                    50: '#FFFFFF',
                    100: '#F8FAFC',
                    200: '#F1F5F9',
                    300: '#E2E8F0',
                    400: '#CBD5E1',
                    500: '#94A3B8',
                    600: '#64748B',
                },
                ink: {
                    900: '#0F172A',
                    800: '#1E293B',
                    700: '#334155',
                    600: '#475569',
                    500: '#64748B',
                    400: '#94A3B8',
                    300: '#CBD5E1',
                },
            },
        },
    },

    plugins: [forms],
};
