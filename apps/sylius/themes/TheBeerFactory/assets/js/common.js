//
// Common
// -----------------------------------------------------------------------------

// Components
import state from './components/states';
import dropdown from './components/dropdown';
import navigation from './components/navigation';
import dialog from './components/dialog';
import selectable from './components/selectable';

document.addEventListener('DOMContentLoaded', () => {
  const components = document.querySelectorAll('[data-component]');

  components.forEach((component) => {
    const dataComponent = component.dataset.component;

    switch (dataComponent) {
      case 'state':
        state(component);
        break;
      case 'dropdown':
        dropdown(component);
        break;
      case 'navigation':
        navigation(component);
        break;
      case 'dialog':
        dialog(component);
        break;
      case 'selectable':
        selectable(component);
        break;
      default:
        break;
    }
  });
});
