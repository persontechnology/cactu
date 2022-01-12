(function() {

    // classList support for class management
    // altho to be fair, the api sucks because it won't accept multiple classes at once
    var hasClass, addClass, removeClass;

    if ('classList' in document.documentElement) {
        hasClass = function(elem, c) {
            return elem.classList.contains(c);
        };
        addClass = function(elem, c) {
            elem.classList.add(c);
        };
        removeClass = function(elem, c) {
            elem.classList.remove(c);
        };
    } else {
        hasClass = function(elem, c) {
            return classReg(c).test(elem.className);
        };
        addClass = function(elem, c) {
            if (!hasClass(elem, c)) {
                elem.className = elem.className + ' ' + c;
            }
        };
        removeClass = function(elem, c) {
            elem.className = elem.className.replace(classReg(c), ' ');
        };
    }

    function toggleClass(elem, c) {
        var fn = hasClass(elem, c) ? removeClass : addClass;
        fn(elem, c);
    }

    var classie = {
        // full names
        hasClass: hasClass,
        addClass: addClass,
        removeClass: removeClass,
        toggleClass: toggleClass,
        // short names
        has: hasClass,
        add: addClass,
        remove: removeClass,
        toggle: toggleClass
    };

    var button = document.getElementById('cn-button'),
        wrapper = document.getElementById('cn-wrapper'),
        overlay = document.getElementById('cn-overlay');

    //open and close menu when the button is clicked
    var open = false;
    button.addEventListener('click', handler, false);
    wrapper.addEventListener('click', cnhandle, false);

    function cnhandle(e) {
        e.stopPropagation();
    }

    function handler(e) {
        if (!e) var e = window.event;
        e.stopPropagation(); //so that it doesn't trigger click event on document

        if (!open) {
            openNav();
        } else {
            closeNav();
        }
    }

    function openNav() {
        open = true;
        button.innerHTML = "-";

        classie.add(wrapper, 'opened-nav');
    }

    function closeNav() {
        open = false;
        button.innerHTML = "+";

        classie.remove(wrapper, 'opened-nav');
    }
    document.addEventListener('click', closeNav);

    $("#mytabs a").click(function(e) {
        e.preventDefault();
        $(this).tab('show');
        closeNav();
    });
})();