import './bootstrap';

window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-menu-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
      const target = document.getElementById(button.dataset.menuToggle);
      target?.classList.toggle('hidden');
    });
  });
});
