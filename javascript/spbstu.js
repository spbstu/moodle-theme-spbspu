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
        sidebarHeight;
    
    if (admin_block) {
        admin_block.wrap('<div class="block_adminblock-container">').wrap('<div class="block_adminblock-wrapper">');
    }

    if (sidebar) {
        sidebarHeight = sidebar.get('offsetHeight');
        Y.one(window).on('scroll', function(e) {
            controlSidebar();
        });
    }

    function controlSidebar() {
        var body = Y.one('body');
        if (sidebar.get('docScrollY') > sidebarHeight) {
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
});