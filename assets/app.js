import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

const navLinkEls = document.querySelectorAll('.nav_link');
const navItemEls = document.querySelectorAll('.nav_item');
const sectionEls = document.querySelectorAll('.section');

let currentSection = 'moveIn';
window.addEventListener('scroll', () => {
    sectionEls.forEach(sec => {
        if(window.scrollY >= (sec.offsetTop - 50)) {
            currentSection = sec.id
        }
    });

    navLinkEls.forEach(navLink => {
        if(navLink.href.includes(currentSection)){
            navLink.parentElement.classList.add('active');
        }
        else{
            navLink.parentElement.classList.remove("active")
        }
    })
})
