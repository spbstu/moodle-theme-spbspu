$(function(){
    var admin_block = $('.block_adminblock'),
        admin_block_offset_init = 5,
        admin_block_offset = 85,
        win = $(window),
        table_data = $('.generaltable'),
        table_data_container = $('.generalbox');

    win.scroll(function() {

        if(win.scrollTop() > admin_block_offset_init) {
            admin_block.css({
                'top': win.scrollTop() - admin_block_offset + 'px'
            })
        } else {
            admin_block.css({
                'top': -admin_block_offset + 'px'
            })
        }
    });

    if(table_data.width() > table_data_container.width()){
        table_data_container.jScrollPane({
            showArrows: true
        });
    }
});