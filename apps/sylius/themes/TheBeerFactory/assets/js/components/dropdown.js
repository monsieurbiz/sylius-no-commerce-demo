//
// Dropdown
// -----------------------------------------------------------------------------

const bp = {
  sm: 768,
  md: 1024,
};

const classes = {
  focus: '--focus',
  open: '--open',
  fixed: '--fixed',
};

const ariaAttributes = [
  {
    type: 'aria-hidden',
    init: true,
  },
  {
    type: 'aria-disabled',
    init: true,
  },
  {
    type: 'aria-selected',
    init: false,
  },
  {
    type: 'aria-expanded',
    init: false,
  },
  {
    type: 'aria-pressed',
    init: false,
  },
  {
    type: 'aria-checked',
    init: false,
  },
];

const KEY_CODES = {
  enter: 13,
  space: 32,
  escape: 32,
};

function toggleClass(elem, target) {
  elem.classList.toggle(classes.focus);
  target.classList.toggle(classes.open);
}

function setAria(elem) {
  ariaAttributes.forEach((ariaAttribute) => {
    const { type } = ariaAttribute;

    if (elem.hasAttribute(type)) {
      elem.setAttribute(type, elem.getAttribute(type) !== 'true');
    }
  });
}

function setTabindex(elem, tabindex) {
  if (tabindex === 'true') {
    elem.setAttribute(
      'tabindex',
      elem.getAttribute('tabindex') === '-1' ? 0 : -1,
    );
  }
}

function toggleState(elem, parameters) {
  const fixValues =
      parameters.fixed !== null ? parameters.fixed : null;

  toggleClass(elem, parameters.target);
  setAria(elem);
  setTabindex(elem, parameters.tabindex);

  if (parameters.fixed) {
    fixValues.forEach((fixValue) => {
      switch (fixValue) {
        case 'sm':
          if (window.innerWidth < bp.sm) {
            document.body.classList.toggle(classes.fixed);
          }
          break;
        case 'md':
          if (window.innerWidth >= bp.sm && window.innerWidth < bp.md) {
            document.body.classList.toggle(classes.fixed);
          }
          break;
        default:
          break;
      }
    });
  }
}

export default function dropdown(elem) {
  const parameters = {
    tabindex: elem.dataset.tabindex
      ? elem.dataset.tabindex
      : null,
    target: document.querySelector(elem.dataset.target),
    fixed: elem.dataset.fixed
      ? elem.dataset.fixed.split(', ')
      : null,
  };
  const preventDefault = elem.dataset.preventDefault !== false;
  const stopPropagation = elem.dataset.stopPropagation !== false;

  elem.addEventListener('click', (event) => {
    if (preventDefault) {
      event.preventDefault();
    }

    if (stopPropagation) {
      event.stopPropagation();
    }

    toggleState(elem, parameters);
  });
  elem.addEventListener('keydown', (event) => {
    if (event.which === KEY_CODES.enter || event.which === KEY_CODES.space || event.which === KEY_CODES.escape) {
      if (preventDefault) event.preventDefault();

      toggleState(elem, parameters);
    }
  });
  document.body.addEventListener('click', (event) => {
    if (elem.classList.contains(classes.focus)) {
      let targetElement = event.target;

      do {
        if (targetElement === elem) {
          return;
        }
        targetElement = targetElement.parentNode;
      } while (targetElement);

      toggleState(elem, parameters);
    }
  });
}
