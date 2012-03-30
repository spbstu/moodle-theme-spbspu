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
    var admin_block = Y.one('.block_adminblock');
    if (admin_block) {
        admin_block.wrap('<div class="block_adminblock-container">').wrap('<div class="block_adminblock-wrapper">');
    }
    });