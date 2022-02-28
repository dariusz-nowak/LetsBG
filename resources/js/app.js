require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (document.querySelector('header')) {

  const currency = document.querySelector('header .currency')
  const currencyForm = document.querySelector('header .currency-form')

  const language = document.querySelector('header .language')
  const languageForm = document.querySelector('header .language-form')

  const search = document.querySelector('.search')
  const searchForm = document.querySelector('.search-form')

  const favGamesBtn = document.querySelector('.fav-games')
  const favGamesMenu = document.querySelector('.fav-games-menu')

  const userBtn = document.querySelector('.user')
  const userMenu = document.querySelector('.user-menu')

  currency.addEventListener('click', () => {
    currencyForm.classList.toggle('active');
    languageForm.classList.remove('active')
  })

  language.addEventListener('click', () => {
    languageForm.classList.toggle('active');
    currencyForm.classList.remove('active')
  })

  search.addEventListener('click', e => {
    e.preventDefault()
    searchForm.classList.toggle('active')
    if (document.querySelector('.fav-games-menu')) document.querySelector('.fav-games-menu').classList.remove('active')
    if (document.querySelector('.user-menu')) document.querySelector('.user-menu').classList.remove('active')
  })

  favGamesBtn.addEventListener('click', e => {
    e.preventDefault()
    favGamesMenu.classList.toggle('active')
    userMenu.classList.remove('active')
    searchForm.classList.remove('active')
  })

  userBtn.addEventListener('click', e => {
    e.preventDefault()
    favGamesMenu.classList.remove('active')
    userMenu.classList.toggle('active')
    searchForm.classList.remove('active')
  })
}

if (document.querySelector('.free')) {
  if (document.querySelector('.free').firstChild.checked) document.querySelector('.prices').classList.add('hide')
  document.querySelector('.free').addEventListener('change', () => document.querySelector('.prices').classList.toggle('hide'))
}

function hideAllMenus(){
  if (document.querySelector('.fav-games-menu')) document.querySelector('.fav-games-menu').classList.remove('active')
  if (document.querySelector('.user-menu')) document.querySelector('.user-menu').classList.remove('active')
  if (document.querySelector('.currency-form')) document.querySelector('.currency-form').classList.remove('active')
  if (document.querySelector('.language-form')) document.querySelector('.language-form').classList.remove('active')
  if (document.querySelector('.search-form')) document.querySelector('.search-form').classList.remove('active')
}

document.querySelector('body>.content').addEventListener('click', () => hideAllMenus())
document.querySelector('body>footer').addEventListener('click', () => hideAllMenus())
