// tailwind.config.js
module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        'black-700': 'rgb(36, 41, 47)',
        'positive-green': 'rgb(31, 136, 61)',
        'positive-green-900': 'rgb(31, 136, 80)',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}