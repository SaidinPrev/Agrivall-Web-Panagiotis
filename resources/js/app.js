import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  const navList = document.querySelector('#navList');
  const menuIcon = document.querySelector('#headerNav nav i');

  if (!navList || !menuIcon) {
    return;
  }

  menuIcon.addEventListener('click', () => {
    navList.style.display = 'block';

  });
});