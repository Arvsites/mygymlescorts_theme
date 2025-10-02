module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './tailwind-classes.html' // 👈 вот он
  ],
  safelist: [
    'burger-line', 
    'burger-active'
  ],
  theme: {
    extend: {},
    screens: {
      'sm': '640px',
      'md': '768px',
      'lgm': '1060px', // изменено с 1024px
      'lg': '1150px', // изменено с 1024px
      'xl': '1280px',
      '2xl': '1536px',
    },
  },
  plugins: []
}
