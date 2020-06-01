// for page including in html file
function includeHTML() {
  var z, i, elmnt, file, xhttp;
  /*loop through a collection of all HTML elements:*/
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("include-html");
    if (file) {
      /*make an HTTP request using the attribute value as the file name:*/
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {elmnt.innerHTML = this.responseText;}
          if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
          /*remove the attribute, and call this function once more:*/
          elmnt.removeAttribute("include-html");
          includeHTML();
        }
      }      
      xhttp.open("GET", file, true);
      xhttp.send();
      /*exit the function:*/
      return;
    }
  }
};

includeHTML();

// include end

// navigation
$(window).scroll(function(){
  if ($(window).scrollTop() >= 490) {
      $('nav').addClass('fixed-header');
      $('nav ').addClass('sec-color');
      $('nav .navbar-brand span').removeClass('nav-brand-txt');
      $('.search-form input').removeClass('seacrh-input');
      $('.search-form button').removeClass('search-btn');
      $('nav .navbar-brand span').addClass('nav-brand-txt-after');
      $('.search-form input').addClass('search-input-after');
      $('.search-form button').addClass('search-btn-after');

  }
  else {
      $('nav').removeClass('fixed-header');
      $('nav ').removeClass('sec-color');
      $('nav .navbar-brand span').removeClass('nav-brand-txt-after');
      $('nav .navbar-brand span').addClass('nav-brand-txt');
      $('.search-form input').addClass('seacrh-input');
      $('.search-form button').addClass('search-btn');
      $('.search-form input').removeClass('search-input-after');
      $('.search-form button').removeClass('search-btn-after');
  }
});