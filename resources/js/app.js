require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (document.querySelector('header')) {

  const navBtn = document.querySelector('.nav-icon')
  const navMenu = document.querySelector('.nav-container')

  const favGamesBtn = document.querySelector('.fav-icon')
  const favGamesMenu = document.querySelector('.fav-container')

  const userBtn = document.querySelector('.user-icon')
  const userMenu = document.querySelector('.user-container')

  const search = document.querySelector('.search-icon')
  const searchForm = document.querySelector('.search-container')

  navBtn.addEventListener('click', e => {
    e.preventDefault()
    navMenu.classList.toggle('active')
    favGamesMenu.classList.remove('active')
    userMenu.classList.remove('active')
    searchForm.classList.remove('active')
  })

  favGamesBtn.addEventListener('click', e => {
    e.preventDefault()
    favGamesMenu.classList.toggle('active')
    userMenu.classList.remove('active')
    searchForm.classList.remove('active')
    navMenu.classList.remove('active')
  })

  userBtn.addEventListener('click', e => {
    e.preventDefault()
    favGamesMenu.classList.remove('active')
    userMenu.classList.toggle('active')
    searchForm.classList.remove('active')
    navMenu.classList.remove('active')
  })

  search.addEventListener('click', e => {
    e.preventDefault()
    searchForm.classList.toggle('active')
    if (document.querySelector('.fav-container')) document.querySelector('.fav-container').classList.remove('active')
    if (document.querySelector('.user-container')) document.querySelector('.user-container').classList.remove('active')
    if (document.querySelector('.nav-container')) document.querySelector('.nav-container').classList.remove('active')
  })
}

if (document.querySelector('.free')) {
  if (document.querySelector('.free').firstChild.checked) document.querySelector('.prices').classList.add('hide')
  document.querySelector('.free').addEventListener('change', () => document.querySelector('.prices').classList.toggle('hide'))
}

function hideAllMenus() {
  if (document.querySelector('.fav-container')) document.querySelector('.fav-container').classList.remove('active')
  if (document.querySelector('.user-container')) document.querySelector('.user-container').classList.remove('active')
  if (document.querySelector('.search-form')) document.querySelector('.search-form').classList.remove('active')
  if (document.querySelector('.nav-container')) document.querySelector('.nav-container').classList.remove('active')
}

document.querySelector('body>.content').addEventListener('click', () => hideAllMenus())
document.querySelector('body>footer').addEventListener('click', () => hideAllMenus())
