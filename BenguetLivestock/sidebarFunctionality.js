$(document).ready(function(){
    // Add click event listener to all sidebar links with the 'collapsed' class
    $('.sidebar-link.collapsed').on('click', function(){
        // Remove 'active' class from all sidebar items
        $('.sidebar-item').removeClass('active');
        
        // Add 'active' class to the clicked parent item
        $(this).closest('.sidebar-item').addClass('active');
    });
});