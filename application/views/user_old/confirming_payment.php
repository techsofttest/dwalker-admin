<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirming Payment | D. Walker Jewellers</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1a365d;
      --gold: #b79a62;
      --gold-dark: #8c7241;
      --bg-cream: #faf9f6;
      --text-dark: #1c1917;
      --text-muted: #78716c;
      --border: #e7e5e4;
      --success: #15803d;
      --danger: #b91c1c;
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      background: var(--bg-cream);
      color: var(--text-dark);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .card {
      background: #ffffff;
      max-width: 540px;
      width: 100%;
      border-radius: 8px;
      box-shadow: 0 20px 40px -15px rgba(0,0,0,0.08), 0 0 1px 1px rgba(0,0,0,0.04);
      padding: 44px 36px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #1a365d, #b79a62, #1a365d);
    }
    .logo-wrap {
      margin-bottom: 28px;
    }
    .logo-wrap img {
      max-height: 44px;
      width: auto;
    }
    .status-badge {
      display: inline-block;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      padding: 6px 14px;
      border-radius: 20px;
      margin-bottom: 16px;
      background: #fef3c7;
      color: #92400e;
    }
    .status-badge.success {
      background: #dcfce7;
      color: #166534;
    }
    .status-badge.declined {
      background: #fee2e2;
      color: #991b1b;
    }
    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 12px;
      letter-spacing: -0.01em;
    }
    p.desc {
      font-size: 14px;
      color: var(--text-muted);
      line-height: 1.6;
      margin-bottom: 28px;
    }
    .spinner-wrap {
      margin: 28px 0;
      position: relative;
    }
    .spinner {
      width: 56px;
      height: 56px;
      border: 3px solid rgba(183, 154, 98, 0.2);
      border-top-color: var(--gold);
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    .info-box {
      background: #fafaf9;
      border: 1px solid var(--border);
      border-radius: 6px;
      padding: 16px 20px;
      text-align: left;
      font-size: 13px;
      margin-bottom: 24px;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      padding: 6px 0;
      border-bottom: 1px dashed #e7e5e4;
    }
    .info-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }
    .info-label {
      color: var(--text-muted);
    }
    .info-val {
      font-weight: 600;
      color: var(--text-dark);
      font-family: monospace;
    }
    .btn {
      display: inline-block;
      width: 100%;
      background: var(--gold);
      color: #000;
      font-weight: 700;
      font-size: 12px;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      padding: 14px 20px;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.2s;
      cursor: pointer;
      border: none;
    }
    .btn:hover {
      background: var(--gold-dark);
      color: #fff;
    }
    .hidden {
      display: none !important;
    }
    .fade-in {
      animation: fadeIn 0.4s ease-in;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="card">
    <div class="logo-wrap">
      <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="D. Walker Jewellers" onerror="this.src='https://www.dwalker.co.nz/assets/images/logo.png'" />
    </div>

    <!-- PENDING STATE -->
    <div id="state-pending">
      <span class="status-badge">Verifying Secure Payment</span>
      <h1 id="title-text">Confirming Payment...</h1>
      <p class="desc">
        Please do not refresh or close this window. We are confirming your transaction with Windcave through our Fail-Proof Result Notification service.
      </p>

      <div class="spinner-wrap">
        <div class="spinner"></div>
      </div>

      <div class="info-box">
        <div class="info-row">
          <span class="info-label">Session ID</span>
          <span class="info-val"><?php echo !empty($session_id) ? htmlspecialchars(substr($session_id, 0, 16)) . '...' : 'Processing'; ?></span>
        </div>
        <div class="info-row">
          <span class="info-label">Gateway Status</span>
          <span class="info-val" id="gateway-status-badge">Awaiting Notification</span>
        </div>
      </div>
    </div>

    <!-- APPROVED STATE -->
    <div id="state-approved" class="hidden fade-in">
      <span class="status-badge success">Payment Confirmed</span>
      <h1>Thank You For Your Order!</h1>
      <p class="desc">
        Your payment has been successfully approved and finalized. A confirmation receipt has been sent to your email.
      </p>

      <div class="info-box">
        <div class="info-row">
          <span class="info-label">Order Reference</span>
          <span class="info-val" id="approved-order-id"></span>
        </div>
        <div class="info-row">
          <span class="info-label">Total Amount</span>
          <span class="info-val" id="approved-total"></span>
        </div>
      </div>

      <a href="<?php echo base_url(); ?>" class="btn">Continue Shopping</a>
    </div>

    <!-- DECLINED STATE -->
    <div id="state-declined" class="hidden fade-in">
      <span class="status-badge declined">Transaction Declined</span>
      <h1>Payment Unsuccessful</h1>
      <p class="desc">
        Unfortunately, your payment could not be processed by Windcave. Please review your payment details or try another card.
      </p>

      <a href="<?php echo base_url(); ?>Cart/MyCart" class="btn">Return to Cart</a>
    </div>
  </div>

  <script>
    (function() {
      var sessionId = <?php echo json_encode(!empty($session_id) ? $session_id : ''); ?>;
      if (!sessionId) {
        var params = new URLSearchParams(window.location.search);
        sessionId = params.get('sessionId') || params.get('id');
      }

      var attempts = 0;
      var maxAttempts = 30; // 30 * 2s = 60s max polling

      function checkStatus() {
        if (!sessionId) return;
        attempts++;

        fetch('<?php echo base_url(); ?>api/payment/status?sessionId=' + encodeURIComponent(sessionId))
          .then(function(res) { return res.json(); })
          .then(function(json) {
            if (json && json.status === 'success' && json.data) {
              var pStatus = json.data.payment_status;

              if (pStatus === 'approved') {
                document.getElementById('state-pending').classList.add('hidden');
                document.getElementById('state-declined').classList.add('hidden');
                document.getElementById('state-approved').classList.remove('hidden');

                document.getElementById('approved-order-id').innerText = json.data.order_id || json.data.order_id_final || 'DWJ-ORDER';
                document.getElementById('approved-total').innerText = json.data.total ? ('$' + parseFloat(json.data.total).toFixed(2) + ' NZD') : '';
                return;
              } else if (pStatus === 'declined' || pStatus === 'failed') {
                document.getElementById('state-pending').classList.add('hidden');
                document.getElementById('state-approved').classList.add('hidden');
                document.getElementById('state-declined').classList.remove('hidden');
                return;
              }
            }

            if (attempts < maxAttempts) {
              setTimeout(checkStatus, 2000);
            } else {
              document.getElementById('gateway-status-badge').innerText = 'Please check orders in account';
            }
          })
          .catch(function(err) {
            if (attempts < maxAttempts) {
              setTimeout(checkStatus, 3000);
            }
          });
      }

      if (sessionId) {
        checkStatus();
      }
    })();
  </script>
</body>
</html>
