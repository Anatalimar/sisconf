/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#007bff',
          50: '#e6f2ff',
          100: '#cce5ff',
          200: '#99cbff',
          300: '#66b0ff',
          400: '#3396ff',
          500: '#007bff',
          600: '#0066cc',
          700: '#004c99',
          800: '#003366',
          900: '#001933',
        },
        secondary: {
          DEFAULT: '#6c757d',
          50: '#f2f3f5',
          100: '#e6e7ea',
          200: '#cccfd6',
          300: '#b3b7c1',
          400: '#999fad',
          500: '#6c757d',
          600: '#575e64',
          700: '#41464c',
          800: '#2c2f33',
          900: '#16171a',
        },
        success: {
          DEFAULT: '#28a745',
          100: '#d4edda',
          500: '#28a745',
          700: '#1e7e34',
        },
        warning: {
          DEFAULT: '#ffc107',
          100: '#fff3cd',
          500: '#ffc107',
          700: '#d39e00',
        },
        danger: {
          DEFAULT: '#dc3545',
          100: '#f8d7da',
          500: '#dc3545',
          700: '#bd2130',
        },
      },
      fontFamily: {
        sans: ['Roboto', 'sans-serif'],
      },
    },
  },
  plugins: [],
};