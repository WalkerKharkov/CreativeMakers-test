$( document ).ready( function(){

   $( '.testTableRow' ).click( function(){
       var token  = $( 'meta[name=csrf-token]' ).attr( 'content' ),
           outputFields = {},
           data = {};
       data[ 'id' ] = $( this ).attr( 'data_id' );
       data[ 'radio' ] = 'Radio';
       data[ 'checkbox' ] = 'CheckBox';
       $( this ).children().each( function(){
           if ( $( this ).attr( 'data-lead' ) ){
               outputFields[ $( this ).attr( 'data-lead' ) ] = $( this ).text();
           }
       });


       $.ajaxSetup( { headers: { 'X-CSRF-TOKEN': token }} );

       $.ajax({
           method: 'POST',
           url: '../agent/testAjax',
           cache: false,
           data: data,
           dataType: 'json',
           success: function( response ) {
               for ( field in response){
                   outputFields[ field ] = response[ field ];
               }
               $( '.result-table' ).show();
               $( '.data-lead' ).each( function(){
                   if ( $( this ).attr( 'data-lead' ) ){
                       $( this ).text( outputFields[ $( this ).attr( 'data-lead' ) ] );
                   }
               })
           },
           error: function ( data ) {
               alert( 'Warning: data access error!' );
           }
       })
   });

   $( '.test-table-close' ).click( function(){
       $( '.result-table' ).hide();
   })

});