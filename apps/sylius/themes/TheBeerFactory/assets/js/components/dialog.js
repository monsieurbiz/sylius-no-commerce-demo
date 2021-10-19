//
// Dialog
// -----------------------------------------------------------------------------

const KEY_CODES = {
  escape: 27,
};

function handleDialogClose(target) {
  document.body.classList.remove('--fixed');
  target.classList.remove('--open');
  target.setAttribute('aria-hidden', 'true');
}

function handleDialogOpen(elem, target) {
  const cancelTriggers = target.querySelectorAll('[data-dialog="close"]');
  const confirmTrigger = target.querySelector('[data-dialog="confirm"]');
  const confirmAction = elem.dataset.dialogConfirm;

  document.body.classList.add('--fixed');
  target.classList.add('--open');
  target.setAttribute('aria-hidden', 'false');

  cancelTriggers.forEach((item) => {
    item.addEventListener('click', (event) => {
      event.preventDefault();

      handleDialogClose(target);
    });
  });

  confirmTrigger.addEventListener('click', (event) => {
    event.preventDefault();

    handleDialogClose(target);

    if (confirmAction === 'submit') {
      elem.closest('form').submit();
    }
  });
}

function handleDialogClick(event, target) {
  if (!event.target.closest('[data-dialog="inner"]')) {
    handleDialogClose(target);
  }
}

export default function dialog(elem) {
  const target = document.querySelector(elem.dataset.target);

  elem.addEventListener('click', (event) => {
    event.preventDefault();

    handleDialogOpen(elem, target);
  });

  target.addEventListener('click', (event) => {
    handleDialogClick(event, target);
  });

  window.addEventListener('keydown', (event) => {
    if (event.which === KEY_CODES.escape && target.classList.contains('--open')) {
      handleDialogClose(target);
    }
  });
}
