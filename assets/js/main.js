document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.js-order-btn');
  const codeInput = document.getElementById('shoe_code');
  const nameEl = document.getElementById('selected-product-name');
  const codeEl = document.getElementById('selected-product-code');
  const priceEl = document.getElementById('selected-product-price');
  const pillEl = document.getElementById('selected-product-pill');
  const selectedCard = document.getElementById('selected-product-card');

  buttons.forEach((button) => {
    button.addEventListener('click', function () {
      const code = this.getAttribute('data-code') || '';
      const title = this.getAttribute('data-title') || 'Selected shoe';
      const price = this.getAttribute('data-price') || 'Price updates here';

      buttons.forEach((btn) => btn.classList.remove('is-active'));
      this.classList.add('is-active');

      if (codeInput) {
        codeInput.value = code;
      }
      if (nameEl) {
        nameEl.textContent = title;
      }
      if (codeEl) {
        codeEl.textContent = code ? `Code: ${code}` : 'Code will appear here automatically.';
      }
      if (priceEl) {
        priceEl.textContent = price ? `Price: ${price}` : 'Price updates when you click ORDER NOW.';
      }
      if (pillEl) {
        pillEl.textContent = code ? `CODE ${code}` : 'CODE —';
      }
      if (selectedCard) {
        selectedCard.classList.add('is-filled');
      }
    });
  });
});
