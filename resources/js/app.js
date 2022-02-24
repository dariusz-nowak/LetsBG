require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (document.querySelector('.user')) {
  const user = document.querySelector('.user')
  const userMenu = document.querySelector('.user-menu')

  user.addEventListener('click', e => {
    e.preventDefault()
    userMenu.classList.toggle('active')
    searchForm.classList.remove('active')
  })
}

if (document.querySelector('.cart')) {
  const cart = document.querySelector('.cart')
  const cartMenu = false;
}

const search = document.querySelector('.search')
const searchForm = document.querySelector('.search-form')

search.addEventListener('click', e => {
  e.preventDefault()
  searchForm.classList.toggle('active')
  if (document.querySelector('.user-menu')) document.querySelector('.user-menu').classList.remove('active')
})

if (document.querySelector('.errors')) {
  setTimeout(() => {
    document.querySelector('.errors').style.opacity = 0
    setTimeout(() => {
      document.querySelector('.errors').remove()
    }, 1000);
  }, 5000);
}


if (document.querySelector('.free')) {
  if (document.querySelector('.free').firstChild.checked) document.querySelector('.prices').classList.add('hide')
  document.querySelector('.free').addEventListener('change', () => document.querySelector('.prices').classList.toggle('hide'))
}
