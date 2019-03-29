//Data Tables Javascript
oTable = $('#table').DataTable({
    dom: 't',
    dom: 'p',
    "dom": '<"top"i>lt<"bottom"p><"clear">',
    "paging": true,
    "searching":true,
    "ordering":false,
    "info":false,
    "lengthChange":false,
    "iDisplayLength":10,
});
$('#search').keyup(function(){
    oTable.search($(this).val()).draw() ;
});
oTable2 = $('#table2').DataTable({
    dom: 't',
    dom: 'p',
    "dom": '<"top"i>lt<"bottom"p><"clear">',
    "paging": true,
    "searching":true,
    "ordering":false,
    "info":false,
    "lengthChange":false,
    "iDisplayLength":10,
});
$('#search2').keyup(function(){
    oTable2.search($(this).val()).draw() ;
});

oTable3 = $('#table3').DataTable({
    dom: 't',
    dom: 'p',
    "dom": '<"top"i>lt<"bottom"p><"clear">',
    "paging": true,
    "searching":true,
    "ordering":false,
    "info":false,
    "lengthChange":false,
    "iDisplayLength":10,
});
$('#search3').keyup(function(){
    oTable3.search($(this).val()).draw() ;
});
oTable4 = $('#table4').DataTable({
    dom: 't',
    dom: 'p',
    "dom": '<"top"i>lt<"bottom"p><"clear">',
    "paging": true,
    "searching":true,
    "ordering":false,
    "info":false,
    "lengthChange":false,
    "iDisplayLength":4,
});
$('#search4').keyup(function(){
    oTable4.search($(this).val()).draw() ;
});

oTable5 = $('#table5').DataTable({
    dom: 't',
    dom: 'p',
    "dom": '<"top"i>lt<"bottom"p><"clear">',
    "paging": true,
    "searching":true,
    "ordering":false,
    "info":false,
    "lengthChange":false,
    "iDisplayLength":7,
});
$('#search5').keyup(function(){
    oTable5.search($(this).val()).draw() ;
});

oTable6 = $('#table6').DataTable({
    dom: 't',
    dom: 'p',
    "dom": '<"top"i>lt<"bottom"p><"clear">',
    "paging": true,
    "searching":true,
    "ordering":false,
    "info":false,
    "lengthChange":false,
    "iDisplayLength":4,
});
$('#search6').keyup(function(){
    oTable6.search($(this).val()).draw() ;
});
$('#link_pages').click(function (e){
    e.preventDefault();
    $('#page1').fadeOut('slow',function () {
        $('#page2').fadeIn('1');
    });
});
$('#link_pages2').click(function (e){
    e.preventDefault();
    $('#page2').fadeOut('slow',function () {
        $('#page1').fadeIn('1');
    });
});
$('#link_pages3').click(function (e){
    e.preventDefault();
    $('#page3').fadeOut('slow',function () {
        $('#page4').fadeIn('1');
    });
});
$('#link_pages4').click(function (e){
    e.preventDefault();
    $('#page4').fadeOut('slow',function () {
        $('#page3').fadeIn('1');
    });
});
$('#link_pages5').click(function (e){
    e.preventDefault();
    $('#page5').fadeOut('slow',function () {
        $('#page6').fadeIn('1');
    });
});
$('#link_pages6').click(function (e){
    e.preventDefault();
    $('#page6').fadeOut('slow',function () {
        $('#page5').fadeIn('1');
    });
});

function isConfirm() {
    if(confirm('Are you sure you want to Revert this item')){
        return true;
    }
    else{
        return false;
    }
}
