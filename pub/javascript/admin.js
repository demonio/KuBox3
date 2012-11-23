
// ACTION BUTTONS
$( 'button[data-action]' ).on( 'mouseenter mouseover click', function()
{
    $( this ).parents( 'form' )
        .attr( 'action', $( this ).data( 'action' ) )
        .attr( 'target', $( this ).data( 'target' ) );
});

// ELEMENTS LIST AS ACCORDION
$( 'a.icon-plus' ).parent().find( 'ul:first' ).hide();
$( 'a.icon-plus,a.icon-minus' ).css( { 'cursor':'pointer' } ).on( 'click', function()
{
    if ( $( this ).hasClass( 'icon-plus' ) )
    {
        $( this ).removeClass( 'icon-plus' ).addClass( 'icon-minus' );
        $( this ).parent().find( 'ul:first' ).show();
    }
    else
    {
        $( this ).removeClass( 'icon-minus' ).addClass( 'icon-plus' );
        $( this ).parent().find( 'ul:first' ).hide();
    }
});

// OPEN LIST WITH ITEM SELECTED ( ESTO HA QUEDADO FINO FINO, NO TOCAR )
$( 'div[data-item="'+$( 'ul[data-open]' ).data( 'open' )+'"]' )
    .parents( 'ul' ).show()
    .prevAll( 'a.icon-plus' ).removeClass( 'icon-plus' ).addClass( 'icon-minus' );

// FILE AND FOLDER LIST AS ACCORDION
$( 'i.icon-folder-close' ).parent().parent().find( 'ul' ).hide();
$( 'i.icon-folder-close' ).parent().css( 'cursor', 'pointer' ).on( 'click', function( e )
{
    e.preventDefault();
        
    if ( $( this ).find( 'i' ).hasClass( 'icon-folder-close' ) )
    {
        $( this ).find( 'i' ).removeClass( 'icon-folder-close' ).addClass( 'icon-folder-open' );
        $( this ).parents( 'li' ).find( 'ul:first' ).show();
        $( 'input[name="dir"]' ).val( $( this ).attr( 'href' ).split( 'admin/files/index/' ).join( '' ) );
    }
    else
    {
        $( this ).find( 'i' ).removeClass( 'icon-folder-open' ).addClass( 'icon-folder-close' );
        $( this ).parent().find( 'ul' ).hide();
        $( 'input[name="dir"]' ).val( $( this ).parent().parent().prev().attr( 'href' ).split( 'admin/files/index/' ).join( '' ) );
    }
});

// SET PARENT DIR ON CLICK A ITEM
$( '.root-folder' ).on( 'click', function( e )
{
    e.preventDefault();
    $( 'input[name="dir"]' ).val( '' );
});

// CONFIRM FOR ELEMENTS WITH REMOVE ICON
$( 'button.btn-danger, .icon-remove' ).on( 'click', function()
{
    if ( confirm( 'Sure?' ) ) return true;
    else return false;
});
