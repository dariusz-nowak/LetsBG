require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const search = document.querySelector('.search')
const searchForm = document.querySelector('.search-form')

search.addEventListener('click', e => {
  e.preventDefault()
  searchForm.classList.toggle('active')
  if (document.querySelector('.fav-games')) document.querySelector('.fav-games').classList.remove('active')
  if (document.querySelector('.user-menu')) document.querySelector('.user-menu').classList.remove('active')
})

if (document.querySelector('.fav-games')) {
  const favGamesBtn = document.querySelector('.fav-games')
  const favGamesMenu = document.querySelector('.fav-games-menu')

  const userBtn = document.querySelector('.user')
  const userMenu = document.querySelector('.user-menu')

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
