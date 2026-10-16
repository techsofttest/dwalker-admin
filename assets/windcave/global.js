ACTION_OVERLAY_ELEMENT_ID = 'action-overlay';
ACTION_CONTAINER_ELEMENT_ID = 'action-container';
SPINNER_ELEMENT_ID = 'spinner';

getJson = (url, callback) => {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'json';
  xhr.onload = () => {
    callback(xhr.response);
  };
  xhr.send();
};

postJson = (url, body, callback) => {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', url, true);
  xhr.responseType = 'json';
  xhr.onload = () => {
  callback(xhr.response);
  };
  xhr.send(JSON.stringify(body) + '\n');
};

showToast = (message) => {
  const toast = document.getElementById('toast');
  toast.innerHTML = message;
  toast.classList.add('show');
  setTimeout(() => {
    toast.classList.remove('show');
  }, 3000);
};

setSelected = (elementId, selected) => {
  selected ? document.getElementById(elementId).classList.add('selected') : document.getElementById(elementId).classList.remove('selected');
};

setHidden = (elementId, hidden) => {
  hidden ? document.getElementById(elementId).classList.add('hidden') : document.getElementById(elementId).classList.remove('hidden');
};

getValue = (elementId) => {
  return document.getElementById(elementId).value;
};

setValue = (elementId, value) => {
  document.getElementById(elementId).value = value;
};

getChecked = (elementId) => {
  return document.getElementById(elementId).checked;
};

setChecked = (elementId, value) => {
  document.getElementById(elementId).checked = value;
};
