//
// Selectable
// -----------------------------------------------------------------------------

function toogleInputState(elem) {
  const input = elem.querySelector('input');

  if (input.checked && input.type === 'checkbox') {
    input.checked = false;
  } else if (input.type === 'checkbox' || input.type === 'radio') {
    input.checked = true;
  }
}

export default function selectable(elem) {
  elem.addEventListener('click', (event) => {
    event.preventDefault();

    toogleInputState(elem);
  });
}
