import $ from 'jquery';
// Uncomment for use BOOTSTAP4
// window.Popper = require('popper.js').default;
// require('bootstrap');
// import 'bootstrap/scss/bootstrap.scss';

import './fonts';
import initLayout from './layout';
import initBlocks from './blocks';
import initPages from './pages';

const setUpCSRFToken = () => {
  let token = document.head.querySelector('meta[name="csrf-token"]');
  if(token) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': token.content
      }
    });
  }else{
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
  }
}

$(() => {
  setUpCSRFToken();
  initLayout();
  initBlocks();
  initPages();
});
