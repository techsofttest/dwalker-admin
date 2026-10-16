const CART_ELEMENT_ID = 'cart-wrapper';
const CART_EMPTY_ELEMENT_ID = 'cart-empty';
const CARDS_ELEMENT_ID = 'cards-wrapper';
const CARDS_EMPTY_ELEMENT_ID = 'cards-empty';
const CHECKOUT_PAYMENT_ELEMENT_ID = 'payment';
const CHECKOUT_HAS_SAVED_CARD_ELEMENT_ID = 'has-saved-card';
const CHECKOUT_CAN_SAVE_CARD_ELEMENT_ID = 'can-save-card';

extractFormData = (formSectionId) => {
  const data = {};
  const formSection = document.getElementById(formSectionId);

  formSection.querySelectorAll('input').forEach((input) => {
    if (!input.disabled) {
      if (input.type === 'text') {
        data[input.name] = input.value;
      } else if (input.type === 'radio') {
        if (input.checked) {
          data[input.name] = input.value;
        }
      } else {
        data[input.name] = input.checked;
      }
    }
  });

  formSection.querySelectorAll('select').forEach((input) => {
    if (!input.disabled) {
      data[input.name] = input.value;
    }
  });

  return data;
};

submitPayment = () => {
  const data = {
    customer: null,
    billingAddress: null,
    shippingAddress: null,
    payment: null,
  };

  data.customer = extractFormData('customer');
  data.billingAddress = extractFormData('billing');
  data.shippingAddress = getChecked('same-as-billing') ? data.billingAddress : extractFormData('shipping-fields');
  data.payment = extractFormData('payment');

  data.payment.useSavedCard = data.payment.useSavedCard === 'true';

  postJson('https://www.dwalker.co.nz/Windcave/processPost', data, (response) => {
    window.location.href = response;
  });
};

queryPayment = () => {
  const urlSearchParams = new URLSearchParams(window.location.search);

  const data = {
    sessionId: urlSearchParams.get('sessionId'),
    retries: parseInt(urlSearchParams.get('retries')),
  };

  postJson('http://www.dwalker.co.nz/storefront/callback', data, (response) => {
    window.location.href = response;
  });
};

addNavbar = () => {
  document.getElementById('navbar').innerHTML = `
    <div id="navbar-title" onclick="window.location='/storefront';">Storefront</div>
    <div id="navbar-button-group">
      <div class="icon-button" onclick="window.location='/storefront/cards';">
        <svg fill="white" height="25px" viewBox="0 0 24 24">
          <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"></path>
        </svg>
      </div>

      <div class="icon-button" onclick="window.location='/storefront/cart';">
        <svg fill="white" height="25px" viewBox="0 0 24 24">
          <path
            d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"
          ></path>
        </svg>
        <div id="cart-counter" class="hidden"></div>
      </div>
    </div>
  `;
};

hideActionOverlay = () => {
  document.getElementById(ACTION_OVERLAY_ELEMENT_ID).classList.remove('show');
};

showActionOverlay = (cardId) => {
  const actionOverlay = document.getElementById(ACTION_OVERLAY_ELEMENT_ID);
  const actionContainer = document.getElementById(ACTION_CONTAINER_ELEMENT_ID);

  actionContainer.innerHTML = `
    <h4 class="center">Are you sure you want to delete this card?</h4>
    <div id="button-container-action" class="center">
      <button class="button" onclick="hideActionOverlay();">Cancel</button>
      <button class="button" onclick="deleteCard('${cardId}');">Confirm</button>
    </div>
  `;

  actionOverlay.classList.add('show');
};

updateResult = () => {
  const urlSearchParams = new URLSearchParams(window.location.search);

  const resultElement = document.getElementById('result');
  resultElement.innerHTML = urlSearchParams.get('message');
};

updateProducts = () => {
  getJson('http://www.dwalker.co.nz/storefront/products', (response) => {
    const productContainer = document.getElementById('product-container');
    productContainer.innerHTML = '';
    for (const [id, product] of Object.entries(response)) {
      productContainer.innerHTML += `
      <div class="product">
        <img class="product-icon" src="../images/windcave-icon.png" alt="Windcave Logo" />
        <div class="product-title-wrapper">
          <div class="product-title">${product.name}</div>
          <div>&nbsp;- $${product.price}</div>
        </div>
        <div class="product-description">
          ${product.description}
        </div>
        <button class="button" onclick="addToCart(${id})">Add to Cart</button>
      </div>
      `;
    }
  });
};

updateCart = () => {
  setHidden(CART_ELEMENT_ID, true);
  setHidden(CART_EMPTY_ELEMENT_ID, true);

  getJson('https://www.dwalker.co.nz/windcavepay/app.php/cartItems', (response) => {
    const entries = Object.entries(response);
    if (entries.length == 0) {
      setHidden(CART_EMPTY_ELEMENT_ID, false);
    } else {
      let remainingEntries = entries.length;
      let total = 0;
      const cart = document.getElementById('cart');
      cart.innerHTML = `
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td id="total"></td>
      </tr>
    `;
      const totalElement = document.getElementById('total');

      for (const [id, count] of entries) {
        getJson(`http://www.dwalker.co.nz/storefront/product/${id}`, (product) => {
           
           //console.log(product);
         // console.log(product.price);
          const productTotal = parseFloat(product.price) * count;
          total += productTotal;
          cart.insertAdjacentHTML(
            'afterbegin',
            `<tr>
              <td class="cart-item-title">${product.name}</td>
              <td><img src="../images/windcave-icon.png" alt="Windcave Logo" /></td>
              <td class="cart-item-description">${product.description}</td>
              <td class="cart-item-price">$${product.price}</td>
              <td>
                <div class="cart-item-amount-wrapper">
                  <div class="icon-button" onclick="removeFromCart(${id});">
                    <svg fill="white" height="25px" viewBox="0 0 24 24">
                      <path d="M19 13H5v-2h14v2z"></path>
                    </svg>
                  </div>
                  <div class="cart-item-amount">
                    ${count}
                  </div>
                  <div class="icon-button" onclick="addToCart(${id});">
                    <svg fill="white" height="25px" viewBox="0 0 24 24">
                      <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                    </svg>
                  </div>
                </div>
              </td>
              <td class="cart-item-total">$${productTotal.toFixed(2)}</td>
            </tr>`
          );
          totalElement.innerHTML = `$${total.toFixed(2)}`;

          remainingEntries--;

          if (remainingEntries == 0) {
            setHidden(CART_ELEMENT_ID, false);
          }
        });
      }
    }
  });
};

updateCards = () => {
  setHidden(CARDS_ELEMENT_ID, true);
  setHidden(CARDS_EMPTY_ELEMENT_ID, true);

  getJson('http://www.dwalker.co.nz/storefront/getCards', (response) => {
    if (response.length == 0) {
      setHidden(CARDS_EMPTY_ELEMENT_ID, false);
    } else {
      const cards = document.getElementById('cards');

      cards.innerHTML = '';

      for (const card of response) {
        cards.innerHTML += `
          <tr>
            <td>${card.cardNumber}</td>
            <td>${card.expiry}</td>
            <td>${card.created}</td>
            <td><div class="nav-button" onclick="showActionOverlay('${card.id}');">Delete</div></td>
          </tr>
        `;
      }

      setHidden(CARDS_ELEMENT_ID, false);
    }
  });
};

disableFormFields = (formSectionId) => {
  const formSection = document.getElementById(formSectionId);

  formSection.querySelectorAll('input').forEach((input) => {
    input.disabled = true;
  });

  formSection.querySelectorAll('select').forEach((input) => {
    input.disabled = true;
  });
};

updatePaymentForm = () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const message = urlSearchParams.get('message');

  if (message) {
    const errorElement = document.getElementById('error');
    errorElement.innerHTML = message;
    setHidden('error', false);
  }

  getJson('http://www.dwalker.co.nz/admin/config', (response) => {
    if (response.saveCards) {
      getJson('http://www.dwalker.co.nz/storefront/getCards', (cards) => {
        if (cards.length) {
          const savedCardElement = document.getElementById('saved-card');

          for (const card of cards) {
            savedCardElement.innerHTML += `<option value="${card.id}">${card.cardNumber} Expiry Date: ${card.expiry}</option>`;
          }

          disableFormFields(CHECKOUT_CAN_SAVE_CARD_ELEMENT_ID);
          setHidden(CHECKOUT_HAS_SAVED_CARD_ELEMENT_ID, false);
        } else {
          disableFormFields(CHECKOUT_HAS_SAVED_CARD_ELEMENT_ID);
          setHidden(CHECKOUT_CAN_SAVE_CARD_ELEMENT_ID, false);
        }
      });

      setHidden(CHECKOUT_PAYMENT_ELEMENT_ID, false);
    }
  });
};


updateCartCounter = () => {
  getJson('https://www.dwalker.co.nz/windcavepay/app.php/cartItems', (response) => {
    const cartCounter = document.getElementById('cart-counter');
    const total = Object.keys(response).length != 0 ? Object.values(response).reduce((prev, curr) => prev + curr) : 0;
    if (total === 0) {
      setHidden('cart-counter', true);
    } else {
      cartCounter.innerHTML = total;
      setHidden('cart-counter', false);
    }
  });
};

removeFromCart = (productId) => {
  postJson('http://www.dwalker.co.nz/storefront/cart', { action: 'remove', id: productId }, (response) => {
    updateCartCounter();

    if (location.pathname == '/storefront/cart') {
      updateCart();
    }
  });
};

addToCart = (productId) => {
  postJson('http://www.dwalker.co.nz/storefront/cart', { action: 'add', id: productId }, (response) => {
    updateCartCounter();
    if (location.pathname == '/storefront/cart') {
      updateCart();
    }
  });
};

deleteCard = (cardId) => {
  setHidden(ACTION_CONTAINER_ELEMENT_ID, true);
  setHidden(SPINNER_ELEMENT_ID, false);

  postJson('http://www.dwalker.co.nz/storefront/cards', { id: cardId }, (response) => {
    updateCards();
    hideActionOverlay();
    setHidden(SPINNER_ELEMENT_ID, true);
    setHidden(ACTION_CONTAINER_ELEMENT_ID, false);

    showToast('Card Deleted');
  });
};

window.onload = () => {
  if (location.pathname != '/storefront/callback') {
    addNavbar();
    updateCartCounter();
  }

  switch (location.pathname) {
    case '/storefront':
      updateProducts();
      break;
    case '/storefront/cart':
      updateCart();
      break;
    case '/storefront/cards':
      updateCards();
      break;
    case '/storefront/checkout':
      updatePaymentForm();
      break;
    case '/storefront/callback':
      queryPayment();
      break;
    case '/storefront/result':
      updateResult();
      break;
  }
};
