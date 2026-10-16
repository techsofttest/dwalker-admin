TRANSACTION_CONTAINER_ELEMENT_ID = 'transaction-container';
TRANSACTIONS_TABLE_ELEMENT_ID = 'transactions-table';
TRANSACTION_TABLE_ELEMENT_ID = 'transaction-table';

PAYMENT_OPTIONS = {
  card: 'Card',
  account2account: 'Account 2 Account',
  alipay: 'Alipay',
  applepay: 'Apple Pay',
  paypal: 'PayPal',
  interac: 'Interac',
  unionpay: 'Union Pay',
  humm: 'Humm',
  visacheckout: 'Visa Checkout',
  wechat: 'WeChat',
  googlepay: 'Google Pay',
  zip: 'Zip',
  swish: 'Swish',
};

TRANSACTION_TYPE = {
  void: 'void',
  complete: 'complete',
  refund: 'refund',
};

TRANSACTION_RESULT = {
  approved: 'approved',
  declined: 'declined',
  failed: 'failed',
  pending: 'pending',
};

doAction = (transactionId, transactionType) => {
  let amount = parseFloat(getValue('amount')).toFixed(2);

  if (transactionType === TRANSACTION_TYPE.void) {
    amount = null;
  }

  setHidden(ACTION_CONTAINER_ELEMENT_ID, true);
  setHidden(SPINNER_ELEMENT_ID, false);
  const actionContainer = document.getElementById('action-container');

  postJson('http://www.dwalker.co.nz/admin/transactions', { transactionId, transactionType, amount }, (response) => {
    actionContainer.innerHTML = `
      <h4 class="center">Transaction ${response.result}</h4>
      <div id="button-container-action" class="center">
        <button class="button" onclick="window.location='/admin/transactions';">Ok</button>
      </div>`;

    setHidden(SPINNER_ELEMENT_ID, true);
    setHidden(ACTION_CONTAINER_ELEMENT_ID, false);
  });
};

hideActionOverlay = () => {
  document.getElementById(ACTION_OVERLAY_ELEMENT_ID).classList.remove('show');
};

showActionOverlay = (transactionId, balance, transactionType) => {
  const actionOverlay = document.getElementById(ACTION_OVERLAY_ELEMENT_ID);
  const actionContainer = document.getElementById(ACTION_CONTAINER_ELEMENT_ID);
  let amount = null;

  if (transactionType === TRANSACTION_TYPE.complete || transactionType === TRANSACTION_TYPE.refund) {
    amount = balance;
  }

  if (transactionType === TRANSACTION_TYPE.refund) {
    actionContainer.innerHTML = `
      <h4>Enter refund amount:</h4>
      <input type="number" id="amount" value="${amount}" />
    `;
  } else {
    actionContainer.innerHTML = `
      <h4 class="center">Are you sure you want to ${transactionType} this transaction?</h4>
      <input type="hidden" id="amount" value="${amount}" />
    `;
  }

  actionContainer.innerHTML += `
    <input type="hidden" id="balance" value="${balance}" />
    <div id="button-container-action" class="center">
      <button class="button" onclick="hideActionOverlay();">Cancel</button>
      <button class="button" onclick="doAction('${transactionId}', '${transactionType}');">Confirm</button>
    </div>
  `;

  actionOverlay.classList.add('show');
};

updateConfig = () => {
  getJson('http://www.dwalker.co.nz/admin/config', (response) => {
    console.log(response);
    setValue('api-username',response.apiUsername);
    setValue('api-key', response.apiKey);
    setValue('api-environment', response.environment);
    setValue('payment-type', response.paymentType);
    setValue('save-cards', response.saveCards);
    response.paymentOptions.forEach((option) => {
      setChecked(option, true);
    });
  });
};

updateTransactions = () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const transactionId = urlSearchParams.get('id');

  if (transactionId) {
    getJson(`http://www.dwalker.co.nz/admin/getTransaction?id=${transactionId}`, (response) => {
      const transactionElement = document.getElementById(TRANSACTION_TABLE_ELEMENT_ID);
      const buttonContainerElement = document.getElementById('button-container');
      transactionElement.innerHTML = `
        <tr><th>Transaction Id</th><td>${response.transactionId}</td></tr>
        <tr><th>Parent Transaction Id</th><td>${response.parentTransactionId}</td></tr>
        <tr><th>Status</th><td>${response.status}</td></tr>
        <tr><th>Order Id</th><td>${response.orderId}</td></tr>
        <tr><th>Response Code</th><td>${response.responseCode}</td></tr>
        <tr><th>Response Text</th><td>${response.responseText}</td></tr>
        <tr><th>Auth Code</th><td>${response.authCode}</td></tr>
        <tr><th>Transaction Type</th><td>${response.transactionType}</td></tr>
        <tr><th>Payment Method</th><td>${response.paymentMethod}</td></tr>
        <tr><th>Amount</th><td>${response.amount}</td></tr>
        <tr><th>Currency</th><td>${response.currency}</td></tr>
        <tr><th>Card Holder</th><td>${response.cardHolder}</td></tr>
        <tr><th>Card Expiration</th><td>${response.cardExpiration}</td></tr>
        <tr><th>Payment Authentication</th><td>${response.paymentAuthentication}</td></tr>
        <tr><th>Cvc2 Result</th><td>${response.cvc2Result}</td></tr>
        <tr><th>Created</th><td>${response.created}</td></tr>`;

      if (response.status === 'approved') {
        if (response.transactionType === 'auth' && !response.isVoid && !response.isComplete) {
          buttonContainerElement.innerHTML = `
            <button class="button" onclick="showActionOverlay('${response.transactionId}', '${response.amount}', '${TRANSACTION_TYPE.void}');">Void</button>
            <button class="button" onclick="showActionOverlay('${response.transactionId}', '${response.amount}', '${TRANSACTION_TYPE.complete}');">Complete</button>`;
        } else if ((response.transactionType === 'complete' || response.transactionType === 'purchase') && response.amount != response.amountRefunded) {
          buttonContainerElement.innerHTML = `
            <button class="button" onclick="showActionOverlay('${response.transactionId}', '${parseFloat(
            (response.amount - response.amountRefunded).toPrecision(8)
          )}', '${TRANSACTION_TYPE.refund}');">Refund</button>`;
        }
      }

      setHidden(TRANSACTIONS_TABLE_ELEMENT_ID, true);
      setHidden(TRANSACTION_CONTAINER_ELEMENT_ID, false);
    });
  } else {
    getJson('http://www.dwalker.co.nz/admin/getTransactions', (response) => {
      const transactionsElement = document.getElementById('transactions');

      for (const transaction of response) {
        transactionsElement.innerHTML += `
        <tr>
          <td>${transaction.transactionId}</td>
          <td>${transaction.parentTransactionId}</td>
          <td>${transaction.orderId}</td>
          <td>${transaction.transactionType}</td>
          <td>${transaction.amount}</td>
          <td>${transaction.status}</td>
          <td><div class="nav-button" onclick="window.location='/admin/transactions?id=${transaction.transactionId}';">View</div></td>
        </tr>`;
      }
    });

    setHidden(TRANSACTIONS_TABLE_ELEMENT_ID, false);
  }
};

saveConfig = () => {
  const config = {
    apiUsername: getValue('api-username'),
    apiKey: getValue('api-key'),
    environment: getValue('api-environment'),
    paymentType: getValue('payment-type'),
    saveCards: getValue('save-cards') === 'true',
    paymentOptions: [],
  };

  Object.keys(PAYMENT_OPTIONS).forEach((option) => {
    if (getChecked(option)) {
      config.paymentOptions.push(option);
    }
  });

  postJson('http://www.dwalker.co.nz/admin/config', config, (response) => {
    updateConfig();
    showToast('Config Saved');
  });
};

addNavbar = () => {
  document.getElementById('navbar').innerHTML = `
    <div id="navbar-title" onclick="window.location='/admin';">Admin</div>
    <div id="navbar-button-group">
      <div id="nav-button-config" class="nav-button" onclick="window.location='/admin';">
        Config
      </div>
      <div id="nav-button-transactions" class="nav-button" onclick="window.location='/admin/transactions';">
        Transactions
      </div>
    </div>
  `;
};

populatePaymentOptions = () => {
  const paymentOptionsElement = document.getElementById('payment-options');
  for (const [id, name] of Object.entries(PAYMENT_OPTIONS)) {
    paymentOptionsElement.innerHTML += `
      <label>
        <input type="checkbox" id="${id}" name="${id}">
        ${name}
      </label>
    `;
  }
};

window.onload = () => {
  addNavbar();
  switch (location.pathname) {
    case '/admin':
      setSelected('nav-button-config', true);
      populatePaymentOptions();
      updateConfig();
      break;
    case '/admin/transactions':
      setSelected('nav-button-transactions', true);
      updateTransactions();
      break;
  }
};
