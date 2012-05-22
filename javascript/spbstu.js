$(function(){
    var table_data = $('.generaltable'),
        table_data_container = $('.generalbox');

    if(table_data.width() > table_data_container.width()){
        table_data_container.jScrollPane({
            showArrows: true
        });
    }
});



YUI().use('node', 'event', function(Y) {
    var admin_block = Y.one('.block_adminblock'),
        sidebar = Y.one('#sidebar'),
        body = Y.one('body'),
        body_width = parseInt(body.getStyle('width'), 10);
    
    if (admin_block) {
        admin_block.wrap('<div class="block_adminblock-container">').wrap('<div class="block_adminblock-wrapper">');
    }

    if(body_width < 1024) {
        sidebar.all(".sidebar-content").addClass("sidebar-collapsed");
    }

    Y.one(window).on('load', function(e) {
        stripBreadcrumb();
    });

    if (sidebar) {
        sidebar.all(".sidebar-controls").on("click", function(e) {
            toggleElement(e.target);
        });

        Y.one(window).on('scroll', function(e) {
            controlSidebar();
        });
    }

    function toggleElement(el) {
        var target = el.getAttribute("rel");

        Y.all(target).toggleClass("sidebar-collapsed");
    }

    function stripBreadcrumb() {
        var breadcrumbs = Y.all(".breadcrumb li")["_nodes"];
            // bc_text;

        for (var i = 0, l = breadcrumbs.length; i < l; i++) {
            var bc_item = Y.one(breadcrumbs[i].lastChild),
                bc_text = bc_item.getContent(),
                bc_words = bc_text.split(" "),
                bc_popup;

            if (bc_words.length > 3) {
                bc_item.setContent(bc_words[0] + " ... " + bc_words[bc_words.length - 1]);
                bc_item.
                    addClass('has-popup').
                    setAttribute('data-title', bc_text).
                    removeAttribute('title');

                bc_item.on('mouseenter', addPopup);
            }
        }
    }

    function addPopup(e) {
        var el = e.currentTarget;

        if (el.one('.breadcrumb-popup') === null) {
            el.append("<span class='breadcrumb-popup'>" + el.getAttribute('data-title') + "</span>");
        }
    }

    function controlSidebar() {
        var sidebarHeight = sidebar.get('offsetHeight');

        if (body_width > 1024 && sidebarHeight > 0) {
            if (sidebar.get('docScrollY') >= sidebarHeight) {
                if (sidebar.get('offsetHeight') > sidebarHeight) {
                    sidebarHeight = sidebar.get('offsetHeight');
                    return;
                }
                sidebar.addClass('sidebar-hidden');
                body.addClass('content-only');
            } else {
                sidebar.removeClass('sidebar-hidden');
                body.removeClass('content-only');
            }
        }
    }
});