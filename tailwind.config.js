module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
        colors: {
            'primary-green': '#132A13',
            'secondary-green': '#606C38',
            'light-beige': '#FEFAE0',
            'soft-green': '#CCD5AE',
        },
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
