(function () {
    var toggleBtn = document.getElementById('theme-toggle');
    var body = document.body;

    function applyTheme(isDark) {
        var icon;
        if (toggleBtn) {
            icon = toggleBtn.querySelector('.theme-icon');
        }

        if (isDark) {
            body.classList.add('dark-theme');
            if (icon) { icon.classList.remove('moon'); icon.classList.add('sun'); }
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.remove('dark-theme');
            if (icon) { icon.classList.remove('sun'); icon.classList.add('moon'); }
            localStorage.setItem('theme', 'light');
        }
    }

    var saved = localStorage.getItem('theme');
    var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    applyTheme(saved === 'dark' || (!saved && prefersDark));

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            applyTheme(!body.classList.contains('dark-theme'));
        });
    }

    var cmdInput = document.getElementById('cmd-input');
    var cmdClear = document.getElementById('cmd-clear');

    document.addEventListener('keydown', function (e) {
        if (!cmdInput) return;
        var tag = document.activeElement ? document.activeElement.tagName : '';
        if (e.key === '/' && document.activeElement !== cmdInput && tag !== 'INPUT' && tag !== 'TEXTAREA') {
            e.preventDefault();
            cmdInput.focus();
            cmdInput.select();
        }
    });

    if (cmdInput) {
        cmdInput.focus();
        var len = cmdInput.value.length;
        cmdInput.setSelectionRange(len, len);

        var toggleClear = function () {
            if (!cmdClear) return;
            if (cmdInput.value.length > 0) {
                cmdClear.classList.add('visible');
            } else {
                cmdClear.classList.remove('visible');
            }
        };

        cmdInput.addEventListener('input', toggleClear);
        toggleClear();
    }

    if (cmdClear) {
        cmdClear.addEventListener('click', function () {
            cmdInput.value = '';
            cmdInput.focus();
            cmdClear.classList.remove('visible');
        });
    }

    var sidebarNav = document.querySelector('.sidebar-nav');
    var activeItem = document.querySelector('.sidebar-item.active');
    if (sidebarNav && activeItem) {
        var delta = activeItem.getBoundingClientRect().top - sidebarNav.getBoundingClientRect().top;
        sidebarNav.scrollTop += delta - sidebarNav.clientHeight * 0.3;
    }
})();
