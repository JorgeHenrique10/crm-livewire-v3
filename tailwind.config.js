/** @type {import('tailwindcss').Config} */
import forms from '@tailwindcss/forms'
import typo from '@tailwindcss/typography'

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [forms, typo],
}

