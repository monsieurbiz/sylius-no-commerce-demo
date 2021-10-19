//
// Navigation
// -----------------------------------------------------------------------------

const bp = {
  sm: 768,
  md: 1024,
};

const classes = {
  active: '--active',
  open: '--open',
};

function openSublist(list, link) {
  const container = list.parentNode.parentNode;
  const containerHeight = container.scrollHeight;
  const listHeight = list.scrollHeight;

  container.querySelectorAll('ul').forEach((elem) => {
    elem.style.maxHeight = null;
    elem.classList.remove(classes.open);
  });

  container.querySelectorAll('a').forEach((elem) => {
    elem.classList.remove(classes.active);
  });

  if (container.classList.contains(classes.open)) {
    container.style.maxHeight = `${containerHeight}px`;
  }

  list.style.maxHeight = `${listHeight}px`;
  list.classList.add(classes.open);
  link.classList.add(classes.active);
}

export default function navigation(elem) {
  const items = elem.querySelectorAll('li');

  items.forEach((item) => {
    if (item.getElementsByTagName('ul').length > 0) {
      const itemLink = item.getElementsByTagName('a')[0];
      const itemList = item.getElementsByTagName('ul')[0];

      itemLink.addEventListener('click', (event) => {
        if (window.innerWidth < bp.md) {
          if (!itemList.classList.contains(classes.open)) {
            event.preventDefault();

            openSublist(itemList, itemLink);
          }
        }
      });
    }
  });
}
